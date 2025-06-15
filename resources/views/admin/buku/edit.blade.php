@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">Edit Buku</h2>
    
    <form action="/admin/buku/{{ $buku->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 mb-2">Judul Buku</label>
            <input type="text" id="judul" name="judul" value="{{ $buku->judul }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="pengarang" class="block text-gray-700 mb-2">Pengarang</label>
            <input type="text" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="penerbit" class="block text-gray-700 mb-2">Penerbit</label>
            <input type="text" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="tahun_terbit" class="block text-gray-700 mb-2">Tahun Terbit</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="stok" class="block text-gray-700 mb-2">Stok</label>
            <input type="number" id="stok" name="stok" value="{{ $buku->stok }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="flex justify-end">
            <a href="/admin/buku" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection