@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8"
    x-data="{ showRatingModal: false, selectedProductId: null, currentOrderId: null, rating: 0 }">

    <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Pembelian</h2>

    @forelse ($orders as $order)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="text-sm text-gray-500">Order ID: <span class="font-medium text-gray-900">{{ $order->id }}</span></div>
                        <div class="text-sm text-gray-500">Tanggal: <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</span></div>
                        <div class="text-sm text-gray-500">Status:
                            <span class="font-medium
                                {{-- Menggunakan properti getStatusLabelAttribute dari model Order --}}
                                @php
                                    $statusClass = '';
                                    switch($order->status) {
                                        case \App\Models\Order::STATUS_COMPLETED:
                                            $statusClass = 'text-green-600';
                                            break;
                                        case \App\Models\Order::STATUS_SHIPPED:
                                            $statusClass = 'text-blue-600'; // Contoh: biru untuk dikirim
                                            break;
                                        case \App\Models\Order::STATUS_PROCESSING:
                                            $statusClass = 'text-orange-600'; // Contoh: oranye untuk diproses
                                            break;
                                        case \App\Models\Order::STATUS_PENDING:
                                            $statusClass = 'text-yellow-600'; // Contoh: kuning untuk pending
                                            break;
                                        default:
                                            $statusClass = 'text-gray-600';
                                            break;
                                    }
                                @endphp
                                {{ $statusClass }}">
                                {{ $order->status_label }} {{-- Menggunakan accessor status_label --}}
                            </span>
                        </div>
                    </div>
                    <div class="text-lg font-semibold text-gray-900">
                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="divide-y divide-gray-200">
                    @foreach ($order->items as $item)
                        <div class="py-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-16 h-16 object-cover rounded">
                                <div>
                                    <h4 class="text-gray-900 font-medium">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            @php
                                $rating = \App\Models\ProductRating::where([
                                    'order_id' => $order->id,
                                    'product_id' => $item->product_id,
                                    'user_id' => auth()->id()
                                ])->first();
                            @endphp

                            @if($rating)
                                <div class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            @elseif($order->status === \App\Models\Order::STATUS_COMPLETED) {{-- Menggunakan konstanta --}}
                                <button type="button"
                                    @click="showRatingModal = true; selectedProductId = {{ $item->product_id }}; currentOrderId = {{ $order->id }}"
                                    class="px-4 py-2 bg-pink-100 text-pink-600 rounded-lg hover:bg-pink-200 transition-colors text-sm font-medium">
                                    Beri Rating
                                </button>
                            @else
                                <span class="text-sm text-gray-500">Menunggu pesanan selesai</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shopping-bag text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pembelian</h3>
            <p class="text-gray-500">Mulai belanja untuk melihat riwayat pembelian Anda.</p>
            <a href="{{ route('landing') }}" class="mt-4 inline-block text-pink-600 hover:text-pink-700">
                Mulai Belanja <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    @endforelse

    @include('components.history-rating-modal')
</div>
@endsection