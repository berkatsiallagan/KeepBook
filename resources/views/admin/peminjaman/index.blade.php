@extends('layouts.app')

@section('title', 'Peminjaman Buku')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Peminjaman</h2>
        <a href="/admin/peminjaman/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Peminjaman</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Peminjam</th>
                    <th class="py-2 px-4 border-b">Buku</th>
                    <th class="py-2 px-4 border-b">Tanggal Pinjam</th>
                    <th class="py-2 px-4 border-b">Tanggal Kembali</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $item)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->user->nama }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->buku->judul }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $item->tanggal_pinjam }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        @if($item->tanggal_kembali)
                            {{ $item->tanggal_kembali }}
                        @else
                            <form id="return-form-{{ $item->id }}" action="/admin/peminjaman/{{ $item->id }}/kembalikan" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="button" onclick="confirmReturn(event, {{ $item->id }})" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                    Tandai Sudah Kembali
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <span class="px-2 py-1 rounded-full text-xs {{ $item->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="/admin/peminjaman/{{ $item->id }}/edit" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        <form action="/admin/peminjaman/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmReturn(event, id) {
    if (confirm('Apakah Anda yakin ingin menandai buku ini sebagai dikembalikan?')) {
        document.getElementById('return-form-' + id).submit();
    }
}
</script>
@endsection