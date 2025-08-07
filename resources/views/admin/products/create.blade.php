@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8 p-6">
        {{-- ## PERUBAHAN DI SINI: Menghapus div ikon berwarna ## --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
            <p class="text-gray-600">Isi detail produk di bawah ini untuk menambahkannya ke katalog.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-tag"></i></span>
                    <input type="text" name="name" id="name" class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all bg-gray-50" required placeholder="Contoh: Lipstik Matte">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-folder"></i></span>
                    <select name="category_id" id="category_id" class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all bg-gray-50" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all bg-gray-50" required rows="4" placeholder="Jelaskan detail produk di sini..."></textarea>
            </div>

            <!-- Price & Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">Rp</span>
                        <input type="number" name="price" id="price" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all bg-gray-50 text-left" required placeholder="0">
                    </div>
                </div>
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                    <div class="relative">
                         <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-cubes"></i></span>
                        <input type="number" name="stock" id="stock" class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all bg-gray-50" required placeholder="0">
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                <p class="text-xs text-gray-500 mt-1">Ukuran file maksimal: 10MB. Format: JPG, PNG, GIF.</p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold py-3 px-8 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
