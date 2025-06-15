@extends('layouts.app')

@section('title', 'Dashboard Client')

@section('content')
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-4">Daftar Buku Tersedia</h2>
    @if($buku->isEmpty())
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-gray-600">Tidak ada buku tersedia saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($buku as $book)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-lg mb-2">{{ $book->judul }}</h3>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Pengarang:</span> {{ $book->pengarang }}</p>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Penerbit:</span> {{ $book->penerbit }}</p>
                <p class="text-gray-600 text-sm mb-3"><span class="font-medium">Tahun:</span> {{ $book->tahun_terbit }}</p>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm px-2 py-1 rounded {{ $book->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        Stok: {{ $book->stok }}
                    </span>
                    
                    @if($book->stok > 0)
                    <form action="{{ route('client.pinjam') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin meminjam buku ini?')">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $book->id }}">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors">
                            Pinjam Buku
                        </button>
                    </form>
                    @else
                    <button disabled class="bg-gray-300 text-gray-500 px-3 py-1 rounded text-sm cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Riwayat Peminjaman Anda</h2>
    
    @if($peminjaman->isEmpty())
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-gray-600">Anda belum meminjam buku apapun.</p>
        </div>
    @else
        <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border text-left">No</th>
                        <th class="py-2 px-4 border text-left">Judul Buku</th>
                        <th class="py-2 px-4 border text-left">Tanggal Pinjam</th>
                        <th class="py-2 px-4 border text-left">Tanggal Kembali</th>
                        <th class="py-2 px-4 border text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $loan)
                    <tr>
                        <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border">{{ $loan->buku->judul }}</td>
                        <td class="py-2 px-4 border">{{ date('d/m/Y', strtotime($loan->tanggal_pinjam)) }}</td>
                        <td class="py-2 px-4 border">
                            {{ $loan->tanggal_kembali ? date('d/m/Y', strtotime($loan->tanggal_kembali)) : '-' }}
                        </td>
                        <td class="py-2 px-4 border">
                            <span class="px-2 py-1 rounded-full text-xs {{ $loan->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-sm text-red-600 italic">
                * Harap kembalikan buku tepat waktu dan konfirmasi kepada admin untuk memperbarui status peminjaman Anda.
            </div>
        </div>
    @endif
</div>
@endsection