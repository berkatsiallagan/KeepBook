@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">Tambah Peminjaman Baru</h2>
    
    <form action="/admin/peminjaman" method="POST">
        @csrf
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 mb-2">Peminjam</label>
            <select id="user_id" name="user_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Pilih Peminjam</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="buku_id" class="block text-gray-700 mb-2">Buku</label>
            <select id="buku_id" name="buku_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Pilih Buku</option>
                @foreach($buku as $book)
                <option value="{{ $book->id }}">{{ $book->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="tanggal_pinjam" class="block text-gray-700 mb-2">Tanggal Pinjam</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="tanggal_kembali" class="block text-gray-700 mb-2">Tanggal Kembali (Opsional)</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex justify-end">
            <a href="/admin/peminjaman" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection