@extends('layouts.user-profile-layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 50%, #e0e7ff 100%);
        font-family: 'Inter', sans-serif;
    }
    .gradient-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .gradient-text {
        background: linear-gradient(135deg, #ec4899, #a855f7, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .gradient-button {
        background: linear-gradient(135deg, #ec4899, #a855f7);
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.3);
    }
    .gradient-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.4);
    }
    .order-card {
        background: linear-gradient(135deg, #ffffff 0%, #fdf2f8 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .order-header {
        background: linear-gradient(135deg, #fdf2f8, #f3e8ff);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(236, 72, 153, 0.2);
    }
    .filter-button {
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    .product-item {
        background: linear-gradient(135deg, #ffffff 0%, #fef3f2 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    .empty-state {
        background: linear-gradient(135deg, #ffffff 0%, #fdf2f8 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<div class="relative max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8"
     x-data="{
        showRatingModal: false,
        selectedProductId: null,
        currentOrderId: null,
        rating: 0,
        activeFilter: '{{ request('status', 'all') }}',
        filterOrders(status) {
            this.activeFilter = status;
            const url = new URL(window.location.href);
            if (status === 'all') {
                url.searchParams.delete('status');
            } else {
                url.searchParams.set('status', status);
            }
            window.location.href = url.toString();
        }
     }">

    <!-- Page Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-bold mb-4">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            RIWAYAT PEMBELIAN
        </div>
        <h1 class="text-4xl md:text-6xl font-bold gradient-text mb-4 leading-tight">Perjalanan Belanjamu</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Lihat semua transaksi dan berikan rating untuk produk yang sudah kamu beli</p>
    </div>

    <!-- Filter Section -->
    <div class="gradient-card rounded-3xl p-6 mb-8">
        <div class="flex flex-wrap gap-4 justify-center md:justify-start items-center">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                </svg>
                <span class="text-lg font-bold gradient-text">Filter Status:</span>
            </div>
            
            <div class="flex flex-wrap gap-3">
                <button @click="filterOrders('all')" :class="{ 'gradient-button text-white shadow-lg': activeFilter === 'all', 'bg-white/70 text-gray-700 hover:bg-white border border-pink-200': activeFilter !== 'all' }" class="filter-button px-6 py-3 rounded-full font-bold text-sm backdrop-blur-sm">
                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Semua Pesanan
                </button>
                <button @click="filterOrders('{{ \App\Models\Order::STATUS_COMPLETED }}')" :class="{ 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg': activeFilter === '{{ \App\Models\Order::STATUS_COMPLETED }}', 'bg-white/70 text-gray-700 hover:bg-white border border-green-200': activeFilter !== '{{ \App\Models\Order::STATUS_COMPLETED }}' }" class="filter-button px-6 py-3 rounded-full font-bold text-sm backdrop-blur-sm">
                    <i class="fas fa-check-circle mr-2"></i> Selesai
                </button>
                <button @click="filterOrders('{{ \App\Models\Order::STATUS_SHIPPED }}')" :class="{ 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg': activeFilter === '{{ \App\Models\Order::STATUS_SHIPPED }}', 'bg-white/70 text-gray-700 hover:bg-white border border-blue-200': activeFilter !== '{{ \App\Models\Order::STATUS_SHIPPED }}' }" class="filter-button px-6 py-3 rounded-full font-bold text-sm backdrop-blur-sm">
                    <i class="fas fa-truck mr-2"></i> Dikirim
                </button>
                <button @click="filterOrders('{{ \App\Models\Order::STATUS_PROCESSING }}')" :class="{ 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg': activeFilter === '{{ \App\Models\Order::STATUS_PROCESSING }}', 'bg-white/70 text-gray-700 hover:bg-white border border-orange-200': activeFilter !== '{{ \App\Models\Order::STATUS_PROCESSING }}' }" class="filter-button px-6 py-3 rounded-full font-bold text-sm backdrop-blur-sm">
                    <i class="fas fa-cog mr-2"></i> Diproses
                </button>
                <button @click="filterOrders('{{ \App\Models\Order::STATUS_PENDING }}')" :class="{ 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white shadow-lg': activeFilter === '{{ \App\Models\Order::STATUS_PENDING }}', 'bg-white/70 text-gray-700 hover:bg-white border border-yellow-200': activeFilter !== '{{ \App\Models\Order::STATUS_PENDING }}' }" class="filter-button px-6 py-3 rounded-full font-bold text-sm backdrop-blur-sm">
                    <i class="fas fa-clock mr-2"></i> Menunggu
                </button>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    @forelse ($orders as $order)
        <div class="order-card rounded-3xl overflow-hidden mb-8">
            <!-- Order Header -->
            <div class="order-header px-8 py-6">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold gradient-text uppercase tracking-wide">ID Pesanan: #{{ $order->id }}</div>
                                <div class="text-sm text-gray-600">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-semibold text-gray-700">Status:</span>
                            @php
                                $statusClass = '';
                                $statusIcon = '';
                                switch($order->status) {
                                    case \App\Models\Order::STATUS_COMPLETED: $statusClass = 'from-green-400 to-emerald-500'; $statusIcon = 'fa-check-circle'; break;
                                    case \App\Models\Order::STATUS_SHIPPED: $statusClass = 'from-blue-400 to-indigo-500'; $statusIcon = 'fa-truck'; break;
                                    case \App\Models\Order::STATUS_PROCESSING: $statusClass = 'from-orange-400 to-red-500'; $statusIcon = 'fa-cog'; break;
                                    case \App\Models\Order::STATUS_PENDING: $statusClass = 'from-yellow-400 to-orange-500'; $statusIcon = 'fa-clock'; break;
                                    default: $statusClass = 'from-gray-400 to-gray-500'; $statusIcon = 'fa-info-circle'; break;
                                }
                            @endphp
                            <span class="bg-gradient-to-r {{ $statusClass }} text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center gap-2">
                                <i class="fas {{ $statusIcon }}"></i> {{ $order->status_label }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right space-y-3">
                        <div>
                            <div class="text-sm font-semibold text-gray-600 mb-1">Total Pembayaran</div>
                            <div class="text-3xl font-bold gradient-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        <a href="{{ route('orders.invoice.download', $order) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-pink-300 transition-all duration-300 transform hover:-translate-y-0.5 text-sm">
                            <i class="fas fa-download mr-2 text-pink-500"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-8">
                <div class="space-y-6">
                    @foreach ($order->items as $item)
                        <div class="product-item rounded-2xl p-6">
                            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                                <a href="{{ route('user.products.show', $item->product->id) }}" class="flex items-center space-x-6 flex-grow group cursor-pointer">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-2xl shadow-lg border-2 border-white transform transition-all duration-300 group-hover:scale-110">
                                        <div class="absolute -inset-2 bg-gradient-to-r from-pink-400 to-purple-600 rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-gray-900 font-bold text-xl group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-pink-600 group-hover:to-purple-600 group-hover:bg-clip-text transition-all duration-300">{{ $item->product->name }}</h4>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <span class="bg-gradient-to-r from-pink-100 to-purple-100 text-pink-600 px-3 py-1 rounded-full text-sm font-bold">{{ $item->quantity }} unit</span>
                                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </a>
                                @php
                                    $rating = \App\Models\ProductRating::where(['order_id' => $order->id, 'product_id' => $item->product_id, 'user_id' => auth()->id()])->first();
                                @endphp
                                <div class="flex-shrink-0">
                                    @if($rating)
                                        <div class="bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 px-6 py-3 rounded-2xl shadow-lg border border-yellow-200">
                                            <div class="flex items-center space-x-2">
                                                <span class="font-bold">Rating Anda:</span>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($order->status === \App\Models\Order::STATUS_COMPLETED)
                                        <button type="button" @click="showRatingModal = true; selectedProductId = {{ $item->product_id }}; currentOrderId = {{ $order->id }}; rating = 0" class="gradient-button text-white px-6 py-3 rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            <span>Beri Rating</span>
                                        </button>
                                    @else
                                        <div class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 px-6 py-3 rounded-2xl shadow-lg border border-gray-200 flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                            <span class="font-semibold">Menunggu Selesai</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state rounded-3xl shadow-2xl">
            <div class="text-center py-20 px-8">
                <div class="relative mb-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center mx-auto border-4 border-white shadow-xl">
                        <svg class="w-16 h-16 text-pink-400" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/></svg>
                    </div>
                    <div class="absolute -inset-4 bg-gradient-to-r from-pink-400 to-purple-600 rounded-full blur-xl opacity-20 animate-pulse"></div>
                </div>
                <h3 class="text-4xl font-bold gradient-text mb-6">Belum Ada Riwayat Pembelian</h3>
                <p class="text-gray-600 max-w-xl mx-auto mb-8 text-lg leading-relaxed">Waktunya memulai petualangan belanja yang menakjubkan! Jelajahi koleksi produk pilihan kami dan ciptakan riwayat belanja yang tak terlupakan.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('landing') }}" class="gradient-button text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        <span>Mulai Belanja</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </a>
                    <a href="#" class="gradient-button-secondary text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                        <span>Lihat Kategori</span>
                    </a>
                </div>
            </div>
        </div>
    @endforelse

    <div class="mt-8">
        {{ $orders->links() }}
    </div>

    <!-- Rating Modal -->
    @include('components.history-rating-modal')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.order-card, .gradient-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
@endpush

@push('scripts')
<style>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes pulse-glow {
    0% { box-shadow: 0 0 20px rgba(236, 72, 153, 0.3); }
    50% { box-shadow: 0 0 40px rgba(236, 72, 153, 0.6); }
    100% { box-shadow: 0 0 20px rgba(236, 72, 153, 0.3); }
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}
</style>
@endpush
