<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $peminjaman = Peminjaman::with('buku')
                        ->where('user_id', session('user_id'))
                        ->get();
        
        return view('client.dashboard', compact('buku', 'peminjaman'));
    }

    public function pinjamBuku(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id'
        ]);

        $buku = Buku::find($request->buku_id);
        
        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => session('user_id'),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now()->format('Y-m-d'),
            'status' => 'dipinjam'
        ]);

        // Kurangi stok buku
        $buku->stok -= 1;
        $buku->save();

        return back()->with('success', 'Buku berhasil dipinjam');
    }
}