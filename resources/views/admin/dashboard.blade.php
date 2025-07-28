@extends('layouts.admin')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl mb-8 p-8">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-pink-500/20"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-white/20 backdrop-blur-lg w-16 h-16 rounded-2xl flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">Admin Dashboard</h1>
                            <p class="text-white/90 text-lg">Selamat datang kembali! Kelola toko online Anda dengan mudah</p>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-4 text-center">
                        <div class="text-white/90 text-sm">Hari ini</div>
                        <div class="text-white text-2xl font-bold">{{ date('d M') }}</div>
                        <div class="text-white/90 text-sm">{{ date('Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="group relative overflow-hidden bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-blue-100 to-indigo-100 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-1">Total Users</h3>
                    <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ number_format($userCount) }}</p>
                    <p class="text-xs text-gray-500 mt-2">Registered customers</p>
                </div>
            </div>

            <!-- ## KARTU YANG DIUBAH ## -->
            <div class="group relative overflow-hidden bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-pink-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-purple-100 to-pink-100 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-1">Pesanan Pending</h3>
                    <p class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ number_format($pendingOrdersCount) }}</p>
                    <p class="text-xs text-gray-500 mt-2">Menunggu untuk diproses</p>
                </div>
            </div>

            <!-- Total Products Card -->
            <div class="group relative overflow-hidden bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-teal-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-green-100 to-teal-100 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-1">Total Products</h3>
                    <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">{{ number_format($totalProducts) }}</p>
                    <p class="text-xs text-gray-500 mt-2">In catalog</p>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="group relative overflow-hidden bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-red-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-orange-100 to-red-100 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-1">Monthly Revenue</h3>
                    <p class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 mt-2">This month (Completed Orders)</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
            <!-- Sales Chart - Takes 2/3 width -->
            <div class="xl:col-span-2">
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Sales Analytics</h2>
                            <p class="text-gray-600 mt-1">Product performance this month</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-gradient-to-r from-indigo-100 to-purple-100 px-3 py-1 rounded-full">
                                <span class="text-indigo-600 text-sm font-semibold">This Month</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <canvas id="salesChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Top Products -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Top Products</h3>
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="space-y-3">
                        @forelse($topProducts as $item)
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-100 to-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-pink-600 font-bold text-sm">#{{ $loop->iteration }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800 text-sm">{{ $item->product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->total_quantity_sold }} sold</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold text-green-600">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No sales data for this month yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.products.create') }}" class="block w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center justify-center"><svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>Add Product</div>
                        </a>
                        <a href="{{ route('admin.users') }}" class="block w-full bg-gradient-to-r from-purple-500 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center justify-center"><svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/></svg>Manage Users</div>
                        </a>
                        <a href="{{ route('admin.orders') }}" class="block w-full bg-gradient-to-r from-green-500 to-teal-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center justify-center"><svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg>View Orders</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Recent Activity</h2>
                    <p class="text-gray-600 mt-1">Latest updates from your store</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-600 px-4 py-2 rounded-xl font-semibold hover:shadow-md transition-all duration-300">View All</a>
            </div>
            <div class="space-y-4">
                @forelse($recentOrders as $order)
                <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all duration-300">
                    <div class="bg-gradient-to-br from-green-100 to-teal-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-gray-800">New order received</div>
                        <div class="text-sm text-gray-500">From {{ $order->user->name }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-bold text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-4">No recent activity.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Chart.js Script -->
@push('scripts')
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
    gradient.addColorStop(0.5, 'rgba(139, 69, 193, 0.6)');
    gradient.addColorStop(1, 'rgba(236, 72, 153, 0.4)');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productNames) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($quantities) !!},
                backgroundColor: gradient,
                borderColor: 'rgba(139, 69, 193, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                barThickness: 'flex',
                maxBarThickness: 60,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#6b7280',
                    borderColor: 'rgba(139, 69, 193, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        title: function(context) { return context[0].label; },
                        label: function(context) { return `${context.parsed.y} units sold`; }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#6b7280',
                        font: { size: 12, weight: '500' }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.2)',
                        drawBorder: false
                    },
                    ticks: {
                        precision: 0,
                        color: '#6b7280',
                        font: { size: 12 },
                        callback: function(value) { return value + ' units'; }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutBounce'
            }
        }
    });
</script>
@endpush
@endsection
