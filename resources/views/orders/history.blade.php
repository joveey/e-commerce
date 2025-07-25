@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8"
     x-data="{
        showRatingModal: false,
        selectedProductId: null,
        currentOrderId: null,
        rating: 0,
        activeFilter: '{{ request('status', 'all') }}', // Get status from URL, default to 'all'
        filterOrders(status) {
            this.activeFilter = status;
            const url = new URL(window.location.href);
            if (status === 'all') {
                url.searchParams.delete('status');
            } else {
                url.searchParams.set('status', status);
            }
            window.location.href = url.toString(); // Reload page with new filter
        }
     }">

    {{-- Replaced the large heading with a smaller, more proportional one --}}
    <h2 class="text-3xl font-bold text-rose-800 mb-8 text-center sm:text-left tracking-tight"
        style="font-family: 'Playfair Display', serif;">
        Riwayat Pembelian
    </h2>

    {{-- Filter Section --}}
    <div class="bg-white rounded-xl shadow-md p-4 mb-8 flex flex-wrap gap-3 justify-center md:justify-start items-center border border-rose-100">
        <span class="text-sm font-semibold text-gray-700 mr-2">Filter Status:</span>
        <button
            @click="filterOrders('all')"
            :class="{ 'bg-rose-500 text-white shadow-md': activeFilter === 'all', 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFilter !== 'all' }"
            class="px-5 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform hover:scale-105"
        >
            Semua Pesanan
        </button>
        <button
            @click="filterOrders('{{ \App\Models\Order::STATUS_COMPLETED }}')"
            :class="{ 'bg-green-600 text-white shadow-md': activeFilter === '{{ \App\Models\Order::STATUS_COMPLETED }}', 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFilter !== '{{ \App\Models\Order::STATUS_COMPLETED }}' }"
            class="px-5 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform hover:scale-105"
        >
            <i class="fas fa-check-circle mr-1"></i> Pesanan Selesai
        </button>
        <button
            @click="filterOrders('{{ \App\Models\Order::STATUS_SHIPPED }}')"
            :class="{ 'bg-blue-600 text-white shadow-md': activeFilter === '{{ \App\Models\Order::STATUS_SHIPPED }}', 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFilter !== '{{ \App\Models\Order::STATUS_SHIPPED }}' }"
            class="px-5 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform hover:scale-105"
        >
            <i class="fas fa-truck mr-1"></i> Pesanan Dikirim
        </button>
        <button
            @click="filterOrders('{{ \App\Models\Order::STATUS_PROCESSING }}')"
            :class="{ 'bg-orange-600 text-white shadow-md': activeFilter === '{{ \App\Models\Order::STATUS_PROCESSING }}', 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFilter !== '{{ \App\Models\Order::STATUS_PROCESSING }}' }"
            class="px-5 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform hover:scale-105"
        >
            <i class="fas fa-cog mr-1"></i> Pesanan Diproses
        </button>
        <button
            @click="filterOrders('{{ \App\Models\Order::STATUS_PENDING }}')"
            :class="{ 'bg-yellow-600 text-white shadow-md': activeFilter === '{{ \App\Models\Order::STATUS_PENDING }}', 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFilter !== '{{ \App\Models\Order::STATUS_PENDING }}' }"
            class="px-5 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform hover:scale-105"
        >
            <i class="fas fa-clock mr-1"></i> Pesanan Menunggu
        </button>
    </div>
    {{-- End Filter Section --}}


    @forelse ($orders as $order)
        <div class="bg-gradient-to-br from-white to-rose-50 rounded-2xl shadow-xl overflow-hidden mb-10
                    transform transition-all duration-500 hover:scale-[1.008] hover:shadow-2xl
                    border-t-4 border-rose-300">

            {{-- Order Header --}}
            <div class="bg-rose-100/70 px-8 py-6 border-b border-rose-200 backdrop-blur-sm">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-1">
                        <div class="text-sm text-rose-700 font-semibold uppercase">ID Pesanan:
                            <span class="font-bold text-rose-900 text-lg tracking-wide">{{ $order->id }}</span>
                        </div>
                        <div class="text-sm text-gray-700">Tanggal Pemesanan:
                            <span class="font-medium text-gray-900">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        <div class="text-sm text-gray-700 flex items-center">Status:
                            @php
                                $statusClass = '';
                                $statusIcon = '';
                                switch($order->status) {
                                    case \App\Models\Order::STATUS_COMPLETED:
                                        $statusClass = 'text-green-700 bg-green-100';
                                        $statusIcon = 'fa-check-circle';
                                        break;
                                    case \App\Models\Order::STATUS_SHIPPED:
                                        $statusClass = 'text-blue-700 bg-blue-100';
                                        $statusIcon = 'fa-truck';
                                        break;
                                    case \App\Models\Order::STATUS_PROCESSING:
                                        $statusClass = 'text-orange-700 bg-orange-100';
                                        $statusIcon = 'fa-cog';
                                        break;
                                    case \App\Models\Order::STATUS_PENDING:
                                        $statusClass = 'text-yellow-700 bg-yellow-100';
                                        $statusIcon = 'fa-clock';
                                        break;
                                    default:
                                        $statusClass = 'text-gray-700 bg-gray-100';
                                        $statusIcon = 'fa-info-circle';
                                        break;
                                }
                            @endphp
                            <span class="ml-2 px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }} shadow-sm flex items-center gap-1">
                                <i class="fas {{ $statusIcon }}"></i> {{ $order->status_label }}
                            </span>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-rose-900 flex-shrink-0">
                        Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="p-8">
                <div class="divide-y divide-rose-100">
                    @foreach ($order->items as $item)
                        <div class="py-6 flex flex-col md:flex-row items-center justify-between gap-6">
                            {{-- Corrected route name and parameter as per previous correction --}}
                            <a href="{{ route('user.products.show', $item->product->id) }}" class="flex items-center space-x-6 flex-grow group cursor-pointer">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-24 h-24 object-cover rounded-xl shadow-md border-2 border-rose-100
                                            transform transition-transform duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                <div>
                                    <h4 class="text-gray-900 font-bold text-xl group-hover:text-rose-700 transition-colors duration-200"
                                        style="font-family: 'Playfair Display', serif;">
                                        {{ $item->product->name }}
                                    </h4>
                                    <p class="text-base text-gray-600 mt-1">
                                        {{ $item->quantity }} x <span class="font-semibold">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </a>

                            @php
                                $rating = \App\Models\ProductRating::where([
                                    'order_id' => $order->id,
                                    'product_id' => $item->product_id,
                                    'user_id' => auth()->id()
                                ])->first();
                            @endphp

                            <div class="flex-shrink-0 text-right">
                                @if($rating)
                                    <div class="flex items-center space-x-1 text-sm bg-yellow-50 text-yellow-800 px-4 py-2 rounded-full shadow-inner border border-yellow-100">
                                        <span class="font-semibold mr-1">Rating Anda:</span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                @elseif($order->status === \App\Models\Order::STATUS_COMPLETED)
                                    <button type="button"
                                            @click="showRatingModal = true; selectedProductId = {{ $item->product_id }}; currentOrderId = {{ $order->id }}; rating = 0"
                                            class="inline-flex items-center px-6 py-3 bg-rose-500 text-white rounded-full font-semibold shadow-lg hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 transition-all duration-300">
                                        <i class="far fa-star mr-2"></i> Beri Rating Cantik
                                    </button>
                                @else
                                    <span class="text-sm text-gray-600 px-4 py-2 rounded-full bg-gray-100 border border-gray-200 shadow-sm flex items-center gap-2">
                                        <i class="fas fa-hourglass-half"></i> Menunggu Pesanan Selesai
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white rounded-2xl shadow-xl border-t-4 border-rose-300">
            <div class="w-24 h-24 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-8 border-4 border-rose-200 animate-pulse-slow">
                <i class="fas fa-shopping-basket text-rose-400 text-4xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-4 tracking-wide" style="font-family: 'Playfair Display', serif;">
                Belum Ada Riwayat Pembelian, Yuk Belanja!
            </h3>
            <p class="text-gray-600 max-w-xl mx-auto mb-8 leading-relaxed">
                Sepertinya kamu belum melakukan pembelian apapun. Jelajahi produk-produk pilihan kami dan mulai ciptakan riwayat belanja yang penuh warna.
            </p>
            <a href="{{ route('landing') }}" class="inline-flex items-center px-8 py-4 bg-rose-600 text-white rounded-full font-bold shadow-xl hover:bg-rose-700
                                                focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2
                                                transform transition-all duration-300 text-lg">
                <i class="fas fa-heart mr-3"></i> Mulai Petualangan Belanjamu! <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    @endforelse

    {{-- Rating Modal (Make sure this component is updated to match the new aesthetic if needed) --}}
    @include('components.history-rating-modal')
</div>
@endsection

{{-- Add this to your main layout file or a dedicated CSS file if you want to use the Google Font --}}
@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
@endpush

{{-- Optional: Add this to your main layout file for subtle animations if you don't have them globally --}}
@push('scripts')
<style>
    @keyframes pulse-slow {
        0% { transform: scale(1); }
        50% { transform: scale(1.03); }
        100% { transform: scale(1); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 3s infinite ease-in-out;
    }
</style>
@endpush