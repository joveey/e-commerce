@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Produk</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">No.</th>
                <th class="px-4 py-2">Nama Produk</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Stok</th>
                <th class="px-4 py-2">Gambar</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $product->stock }}</td>
                <td class="px-4 py-2">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="80" class="rounded shadow">
                    @else
                        <span class="text-gray-400 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center p-4">Tidak ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
