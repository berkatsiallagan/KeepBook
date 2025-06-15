@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Buku</h2>
        <a href="/admin/buku/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Buku</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">Pengarang</th>
                    <th class="py-2 px-4 border-b">Penerbit</th>
                    <th class="py-2 px-4 border-b">Tahun</th>
                    <th class="py-2 px-4 border-b">Stok</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $item)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->judul }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->pengarang }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->penerbit }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $item->tahun_terbit }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $item->stok }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="/admin/buku/{{ $item->id }}/edit" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        <form action="/admin/buku/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
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
@endsection