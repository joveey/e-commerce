@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

    <a href="{{ route('products.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Tambah Produk
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-3 border">#</th>
                <th class="px-4 py-3 border">Nama</th>
                <th class="px-4 py-3 border">Harga</th>
                <th class="px-4 py-3 border">Gambar</th>
                <th class="px-4 py-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 border">{{ $product->name }}</td>
                <td class="px-4 py-3 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 border">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="w-20 h-20 object-cover rounded border">
                    @else
                        <span class="text-gray-400 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="px-4 py-3 border">
                    <div class="flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                           Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500 italic">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
