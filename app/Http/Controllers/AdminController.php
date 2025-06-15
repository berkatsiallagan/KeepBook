<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
/**
 * The ActivityLog model is not found in the project.
 * Removing the usage and import of ActivityLog to fix the error.
 */
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalBooks' => Buku::count(),
            'totalLoans' => Peminjaman::where('status', 'dipinjam')->count(),
            'recentLoans' => Peminjaman::with(['user', 'buku'])
                ->latest()
                ->take(5)
                ->get(),
            'popularBooks' => Buku::withCount('peminjaman')
                ->orderBy('peminjaman_count', 'desc')
                ->take(3)
                ->get(),
            // Removed recentActivities because ActivityLog model does not exist
        ]);
    }

    public function bukuIndex()
    {
        $buku = Buku::all();
        return view('admin.buku.index', compact('buku'));
    }

    public function bukuCreate()
    {
        return view('admin.buku.create');
    }

    public function bukuStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        Buku::create($request->all());

        return redirect('/admin/buku')->with('success', 'Buku berhasil ditambahkan');
    }

    public function bukuEdit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.edit', compact('buku'));
    }

    public function bukuUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect('/admin/buku')->with('success', 'Buku berhasil diperbarui');
    }

    public function bukuDestroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect('/admin/buku')->with('success', 'Buku berhasil dihapus');
    }

    public function peminjamanIndex()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function peminjamanCreate()
    {
        $users = User::where('role', 'client')->get();
        $buku = Buku::where('stok', '>', 0)->get();
        return view('admin.peminjaman.create', compact('users', 'buku'));
    }

    public function peminjamanStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date'
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->tanggal_kembali ? 'dikembalikan' : 'dipinjam'
        ]);

        // Kurangi stok buku
        $buku = Buku::find($request->buku_id);
        $buku->stok -= 1;
        $buku->save();

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function peminjamanEdit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::where('role', 'client')->get();
        $buku = Buku::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'buku'));
    }

    public function peminjamanUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // Kembalikan stok buku sebelumnya jika buku diubah
        if ($peminjaman->buku_id != $request->buku_id) {
            $bukuLama = Buku::find($peminjaman->buku_id);
            $bukuLama->stok += 1;
            $bukuLama->save();
        }

        $peminjaman->update([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->tanggal_kembali ? 'dikembalikan' : 'dipinjam'
        ]);

        // Kurangi stok buku baru jika buku diubah dan status adalah dipinjam
        if ($peminjaman->buku_id == $request->buku_id && $peminjaman->status == 'dipinjam') {
            $bukuBaru = Buku::find($request->buku_id);
            $bukuBaru->stok -= 1;
            $bukuBaru->save();
        }

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function peminjamanDestroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Kembalikan stok buku jika status masih dipinjam
        if ($peminjaman->status == 'dipinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            $buku->stok += 1;
            $buku->save();
        }

        $peminjaman->delete();

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil dihapus');
    }

    public function userIndex()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.user.create');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'nama' => 'required',
            'role' => 'required|in:admin,client'
        ]);

        User::create([
            'username' => $request->username,
            'password' => md5($request->password), // <- pakai md5
            'nama' => $request->nama,
            'role' => $request->role
        ]);

        return redirect('/admin/user')->with('success', 'User berhasil ditambahkan');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:6',
            'nama' => 'required',
            'role' => 'required|in:admin,client'
        ]);

        $user = User::findOrFail($id);
        $data = [
            'username' => $request->username,
            'nama' => $request->nama,
            'role' => $request->role
        ];

        if ($request->password) {
            $data['password'] = md5($request->password);
        }        

        $user->update($data);

        return redirect('/admin/user')->with('success', 'User berhasil diperbarui');
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/user')->with('success', 'User berhasil dihapus');
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
