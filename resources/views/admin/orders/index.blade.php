@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 mb-8">
        <div class="container mx-auto px-6 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-clipboard-list text-pink-500 mr-3"></i>
                        Daftar Pesanan Belum Selesai
                    </h1>
                    <p class="text-gray-600">Kelola dan update status pesanan pelanggan</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                        <i class="fas fa-clock mr-2"></i>
                        {{ isset($usersWithActiveOrders) ? $usersWithActiveOrders->total() : 0 }} Customer Aktif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-8">
        @if(isset($usersWithActiveOrders) && $usersWithActiveOrders->count() > 0)
            <div class="space-y-6">
                @foreach ($usersWithActiveOrders as $user)
                    <!-- Customer Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                        <!-- Customer Header -->
                        <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-t-2xl p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                                        <p class="text-gray-600 text-sm">
                                            <i class="fas fa-envelope mr-1"></i>
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                        <p class="text-xs text-gray-500 mb-1">Total Pesanan</p>
                                        <p class="text-lg font-bold text-pink-600">{{ $user->orders->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders List -->
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($user->orders as $orderIndex => $order)
                                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 hover:bg-gray-100 transition-colors">
                                        <!-- Order Header -->
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                    <span class="text-indigo-600 font-bold text-sm">#{{ $orderIndex + 1 }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-800">
                                                        <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                                        {{ $order->created_at->format('d M Y, H:i') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">Order ID: #{{ $order->id }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border">
                                                    <p class="text-xs text-gray-500 mb-1">Total</p>
                                                    <p class="font-bold text-green-600">
                                                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Products Grid -->
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-5">
                                            @foreach ($order->items as $item)
                                                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                                    <div class="flex items-center space-x-4">
                                                        {{-- ## PERUBAHAN DI SINI: Menampilkan Gambar Produk ## --}}
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                             alt="{{ $item->product->name }}" 
                                                             class="w-12 h-12 object-cover rounded-lg flex-shrink-0"
                                                             onerror="this.onerror=null; this.src='https://placehold.co/100x100/fce7f3/db2777?text=Img';">
                                                        
                                                        <div class="flex-1">
                                                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">{{ $item->product->name }}</h4>
                                                            <div class="flex items-center justify-between">
                                                                <span class="text-sm text-gray-600">
                                                                    <i class="fas fa-cube mr-1"></i>
                                                                    Qty: {{ $item->quantity }}
                                                                </span>
                                                                <span class="font-bold text-pink-600">
                                                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Status Update Form -->
                                        <div class="bg-white rounded-xl p-4 border-2 border-dashed border-gray-200">
                                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                            <i class="fas fa-sync-alt text-pink-500 mr-1"></i>
                                                            Update Status Pesanan
                                                        </label>
                                                        <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white text-gray-900 font-medium transition-all">
                                                            @foreach(App\Models\Order::getStatusList() as $value => $label)
                                                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="pt-7">
                                                        <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg hover:shadow-xl">
                                                            <i class="fas fa-save mr-2"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clipboard-list text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Tidak Ada Pesanan Aktif</h3>
                    <p class="text-gray-600 mb-6">Saat ini belum ada pesanan yang perlu diproses. Pesanan baru akan muncul di sini.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($usersWithActiveOrders) && $usersWithActiveOrders->hasPages())
            <div class="mt-8">
                {{ $usersWithActiveOrders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
