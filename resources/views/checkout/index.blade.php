@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Checkout</h1>
        
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow-md p-6">
                
                <!-- Alamat Pengiriman -->
                <div class="border-b-2 border-dashed border-pink-200 pb-6 mb-6">
                    <h2 class="text-xl font-semibold text-pink-600 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt mr-3"></i> Alamat Pengiriman
                    </h2>
                    <div class="bg-pink-50 p-4 rounded-lg border border-pink-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-bold text-gray-800">{{ $user->name }} ({{ $user->phone_number }})</p>
                                <p class="text-gray-600">{{ $user->address }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline font-semibold">Ubah</a>
                        </div>
                    </div>
                </div>

                <!-- Produk Dipesan -->
                <div>
                    <div class="hidden md:grid grid-cols-12 gap-4 text-sm font-semibold text-gray-500 mb-4 px-4">
                        <div class="col-span-6">Produk</div>
                        <div class="col-span-2 text-center">Harga Satuan</div>
                        <div class="col-span-2 text-center">Jumlah</div>
                        <div class="col-span-2 text-right">Subtotal Produk</div>
                    </div>

                    @foreach($items as $item)
                    <div class="grid grid-cols-12 gap-4 items-center border-t py-4 px-4">
                        <div class="col-span-12 md:col-span-6 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md">
                            <span class="font-semibold text-gray-800">{{ $item->product->name }}</span>
                        </div>
                        <div class="col-span-4 md:col-span-2 text-left md:text-center text-gray-600">
                            <span class="md:hidden">Harga: </span>Rp{{ number_format($item->product->price, 0, ',', '.') }}
                        </div>
                        <div class="col-span-4 md:col-span-2 text-left md:text-center text-gray-600">
                            <span class="md:hidden">Jumlah: </span>{{ $item->quantity }}
                        </div>
                        <div class="col-span-4 md:col-span-2 text-left md:text-right font-semibold text-gray-800">
                            <span class="md:hidden">Subtotal: </span>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pesan -->
                <div class="border-t mt-6 pt-6">
                    <label for="pesan" class="font-semibold text-gray-700">Pesan: <span class="text-gray-500 font-normal">(Opsional)</span></label>
                    <textarea name="pesan" id="pesan" rows="2" class="w-full md:w-1/2 mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Tinggalkan pesan untuk penjual..."></textarea>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <!-- Opsi Pengiriman & Pembayaran -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Opsi Pengiriman</h3>
                            <div class="border rounded-lg p-3 flex justify-between items-center">
                                <span>Reguler</span>
                                <span class="font-semibold">Rp{{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Metode Pembayaran</h3>
                            <div class="border rounded-lg p-3 flex justify-between items-center">
                                <span>Cash on Delivery (COD)</span>
                                <i class="fas fa-money-bill-wave text-green-500"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Rincian Pembayaran</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal Produk</span>
                                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal Pengiriman</span>
                                <span>Rp{{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 mt-3">
                                <div class="flex justify-between text-lg font-bold text-gray-900">
                                    <span>Total Pembayaran</span>
                                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8 flex flex-col md:flex-row items-center justify-end">
                <div class="text-right mb-4 md:mb-0 md:mr-6">
                    <span class="text-gray-600">Total Pembayaran:</span>
                    <p class="text-2xl font-bold text-pink-600">Rp{{ number_format($total, 0, ',', '.') }}</p>
                </div>
                <button type="submit" class="w-full md:w-auto bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Buat Pesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
