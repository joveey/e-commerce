@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Produk</h2>
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label>Kategori</label>
            <select name="category_id" class="w-full border px-3 py-2" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Deskripsi</label>
            <textarea name="description" class="w-full border px-3 py-2" required>{{ $product->description }}</textarea>
        </div>
        <div class="mb-4">
            <label>Harga</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full border px-3 py-2" step="0.01" required>
        </div>
        <div class="mb-4">
            <label>Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label>Gambar Saat Ini:</label><br>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" width="100" class="mb-2">
            @else
                <span class="text-gray-400 italic">Tidak ada</span>
            @endif
        </div>
        <div class="mb-4">
            <label>Upload Gambar Baru</label>
            <input type="file" name="image" class="w-full border px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection