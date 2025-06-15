@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">Edit User</h2>
    
    <form action="/admin/user/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ $user->nama }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="username" class="block text-gray-700 mb-2">Username</label>
            <input type="text" id="username" name="username" value="{{ $user->username }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="role" class="block text-gray-700 mb-2">Role</label>
            <select id="role" name="role" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>
        <div class="flex justify-end">
            <a href="/admin/user" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection