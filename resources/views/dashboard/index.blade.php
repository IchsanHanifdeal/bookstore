<x-dashboard.main title="Dashboard">
    <div class="p-6 space-y-6">
        <!-- Welcome Section -->
        <div
            class="bg-gradient-to-r from-indigo-600 to-teal-500 p-6 rounded-lg shadow-lg flex justify-between items-center text-white">
            <div>
                <h2 class="text-2xl font-bold">Selamat Datang di Syahbil Firdaus Berkarya</h2>
                <p class="text-sm opacity-80">Kelola buku, pelanggan, transaksi, dan lainnya dengan mudah.</p>
            </div>
            <x-lucide-book-open class="size-12 opacity-80" />
        </div>

        <!-- Statistik -->
        @php
            $stats = [
                ['icon' => 'book', 'value' => $jumlah_buku, 'label' => 'Total Buku'],
                ['icon' => 'users', 'value' => $jumlah_customer, 'label' => 'Total Customer'],
                ['icon' => 'shopping-cart', 'value' => $jumlah_transaksi, 'label' => 'Total Transaksi'],
                [
                    'icon' => 'dollar-sign',
                    'value' => 'Rp' . number_format($jumlah_pendapatan, 0, ',', '.'),
                    'label' => 'Total Pendapatan',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($stats as $stat)
                <div
                    class="bg-white p-6 rounded-lg shadow-xl flex items-center gap-4 hover:shadow-2xl transition duration-300">
                    @switch($stat['icon'])
                        @case('book')
                            <x-lucide-book class="text-teal-500 size-12" />
                        @break

                        @case('users')
                            <x-lucide-users class="text-indigo-500 size-12" />
                        @break

                        @case('shopping-cart')
                            <x-lucide-shopping-cart class="text-yellow-500 size-12" />
                        @break

                        @case('dollar-sign')
                            <x-lucide-dollar-sign class="text-green-500 size-12" />
                        @break

                        @default
                            <x-lucide-help-circle class="text-gray-500 size-12" />
                    @endswitch

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $stat['value'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Grafik & Transaksi -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-xl">
                <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
                <canvas id="salesChart" class="h-64"></canvas>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse ($transaksi_terbaru as $transaksi)
                        <li class="py-3 flex justify-between items-center">
                            <span class="text-sm">
                                <span
                                    class="font-semibold">{{ $transaksi->customers->nama ?? 'Seorang pelanggan' }}</span>
                                baru saja membeli
                                <span class="font-semibold">{{ $transaksi->bukus->judul_buku ?? 'sebuah buku' }}</span>.
                            </span>
                            <span class="text-sm font-semibold">
                                Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                            </span>
                        </li>
                    @empty
                        <li class="py-3 text-center text-gray-500">Tidak ada transaksi terbaru</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>

    <!-- Chart.js untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('salesChart').getContext('2d');

            const dataTransaksi = {!! $data_transaksi !!};
            const bulanLabels = {!! $bulan_labels !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulanLabels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: dataTransaksi,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(229, 231, 235, 0.5)',
                            },
                        },
                        y: {
                            grid: {
                                color: 'rgba(229, 231, 235, 0.5)',
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</x-dashboard.main>
