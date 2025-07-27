@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Pesanan Belum Selesai</h1>

    @if(isset($usersWithActiveOrders) && $usersWithActiveOrders->count() > 0)
        @foreach ($usersWithActiveOrders as $user)
            {{-- Buat "Kartu" untuk setiap user --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    Pesanan dari: <span class="text-pink-600">{{ $user->name }}</span>
                </h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-600">
                            <tr>
                                <th class="px-4 py-2 text-left border">Tanggal</th>
                                <th class="px-4 py-2 text-left border">Produk</th>
                                <th class="px-4 py-2 text-center border">Jumlah</th>
                                <th class="px-4 py-2 text-right border">Harga</th>
                                <th class="px-4 py-2 text-center border" style="width: 300px;">Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->orders as $order)
                                {{-- Loop untuk setiap item dalam satu pesanan --}}
                                @foreach ($order->items as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        {{-- Tampilkan Tanggal & Aksi hanya pada baris pertama setiap pesanan --}}
                                        @if ($index === 0)
                                            <td class="px-4 py-2 border align-top" rowspan="{{ $order->items->count() }}">
                                                {{ $order->created_at->format('d M Y H:i') }}
                                            </td>
                                        @endif
                                        
                                        {{-- Detail Item --}}
                                        <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                                        <td class="px-4 py-2 text-center border">{{ $item->quantity }}</td>
                                        <td class="px-4 py-2 text-right border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>

                                        {{-- Tampilkan Form Update Status hanya pada baris pertama setiap pesanan --}}
                                        @if ($index === 0)
                                            <td class="px-4 py-2 text-center border align-top" rowspan="{{ $order->items->count() }}">
                                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <select name="status" class="form-select rounded-md border-gray-300 text-sm focus:border-pink-500 focus:ring-pink-200 flex-grow">
                                                            @foreach(App\Models\Order::getStatusList() as $value => $label)
                                                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <p>Belum ada pesanan aktif yang perlu diproses.</p>
        </div>
    @endif

    {{-- Tampilkan link paginasi --}}
    @if(isset($usersWithActiveOrders))
    <div class="mt-6">
        {{ $usersWithActiveOrders->links() }}
    </div>
    @endif
</div>
@endsection