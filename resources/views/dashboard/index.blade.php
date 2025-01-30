<x-dashboard.main title="Dashboard">
    <div class="p-6 space-y-6">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Selamat Datang di Syahbil Firdaus Berkarya</h2>
                <p class="text-sm opacity-80">Kelola buku, pelanggan, transaksi, dan lainnya dengan mudah.</p>
            </div>
            <x-lucide-book-open class="size-12 opacity-80" />
        </div>

        <!-- Statistik -->
        @php
            $stats = [
                ['icon' => 'book', 'value' => 250, 'label' => 'Total Buku'],
                ['icon' => 'users', 'value' => 120, 'label' => 'Total Customer'],
                ['icon' => 'shopping-cart', 'value' => 75, 'label' => 'Total Transaksi'],
                ['icon' => 'dollar-sign', 'value' => 'Rp 12,500,000', 'label' => 'Total Pendapatan'],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($stats as $stat)
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
                    @switch($stat['icon'])
                        @case('book')
                            <x-lucide-book class="size-10" />
                        @break

                        @case('users')
                            <x-lucide-users class="size-10" />
                        @break

                        @case('shopping-cart')
                            <x-lucide-shopping-cart class="size-10" />
                        @break

                        @case('dollar-sign')
                            <x-lucide-dollar-sign class="size-10" />
                        @break

                        @default
                            <x-lucide-help-circle class="size-10" />
                    @endswitch

                    <div>
                        <h3 class="text-xl font-semibold">{{ $stat['value'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Grafik & Transaksi -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>
                <ul class="divide-y divide-gray-200">
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-sm">John Doe - <span class="font-semibold">Buku
                                Laravel</span></span>
                        <span class="text-sm font-semibold">Rp 150,000</span>
                    </li>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-sm">Jane Smith - <span class="font-semibold">ReactJS
                                Handbook</span></span>
                        <span class="text-sm font-semibold">Rp 180,000</span>
                    </li>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-sm">Michael - <span class="font-semibold">Mastering
                                Tailwind</span></span>
                        <span class="text-sm font-semibold">Rp 120,000</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Chart.js untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: [500000, 700000, 900000, 1200000, 1500000, 1800000],
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script> --}}
</x-dashboard.main>
