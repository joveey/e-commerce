@extends('layouts.admin')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Dashboard</h1>

    <!-- Grid Section for Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total User</h2>
            <p class="text-3xl font-bold text-pink-500">{{ $userCount }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Produk di Checkout</h2>
            <p class="text-3xl font-bold text-pink-500">{{ $cartItems->count() }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Produk Terdaftar</h2>
            <p class="text-3xl font-bold text-pink-500">{{ \App\Models\Product::count() }}</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Diagram Penjualan Produk Bulan Ini</h2>
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>

<!-- Chart.js Script -->
@push('scripts')
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productNames) !!},
            datasets: [{
                label: 'Jumlah Terjual',
                data: {!! json_encode($quantities) !!},
                backgroundColor: 'rgba(236, 72, 153, 0.6)',
                borderColor: 'rgba(236, 72, 153, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
