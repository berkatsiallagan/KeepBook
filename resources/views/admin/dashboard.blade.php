@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total User</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Buku</h3>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalBooks }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Buku Dipinjam</h3>
                    <p class="text-3xl font-bold text-orange-600 mt-1">{{ $totalLoans }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Peminjaman Terbaru -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Peminjaman Terbaru</h2>
            <a href="{{ route('admin.peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentLoans as $loan)
                    <tr>
                        <td class="py-3 px-4">{{ $loan->user->nama ?? 'N/A' }}</td>
                        <td class="py-3 px-4">{{ $loan->buku->judul ?? 'N/A' }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $loan->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">Tidak ada data peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Tambahan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Buku Terpopuler -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Buku Terpopuler</h2>
            <div class="space-y-4">
                @forelse($popularBooks as $index => $book)
                <div class="flex items-center">
                    <!-- Nomor Urut -->
                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-semibold mr-4">
                        {{ $index + 1 }}
                    </div>

                    <!-- Info Buku -->
                    <div class="ml-2 flex-grow">
                        <h3 class="text-sm font-medium text-gray-900">{{ $book->judul }}</h3>
                        <p class="text-sm text-gray-500">Dipinjam {{ $book->peminjaman_count }} kali</p>
                    </div>

                    <!-- Icon atau badge jika diperlukan -->
                    @if($index < 3)
                        <div class="ml-2">
                        <span class="px-2 py-1 text-xs rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-800' : ($index == 1 ? 'bg-gray-100 text-gray-800' : 'bg-amber-100 text-amber-800') }}">
                            {{ $index == 0 ? 'Terpopuler' : ($index == 1 ? 'Runner Up' : 'Peringkat 3') }}
                        </span>
                </div>
                @endif
            </div>
            @empty
            <p class="text-gray-500">Tidak ada data buku</p>
            @endforelse
        </div>
    </div>

    <!-- Aktivitas Terakhir -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Aktivitas Terakhir</h2>
        <div class="space-y-4">
            <p class="text-gray-500">Fitur aktivitas terakhir belum tersedia.</p>
        </div>
    </div>
</div>
</div>
@endsection