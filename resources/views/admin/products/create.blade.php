@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block">Harga</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block">Stok</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block">Gambar</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection