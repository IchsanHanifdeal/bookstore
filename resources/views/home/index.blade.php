<x-main title="Home" class="w-full">
    <div class="hero h-[500px] bg-center text-center relative flex flex-col justify-end overflow-hidden">
        <!-- Background Image -->
        <img src="../images/caro-4.jpg" alt="Background Image" class="absolute inset-0 w-full h-full object-cover z-0">

        <!-- Overlay -->
        <div class="hero-overlay bg-black bg-opacity-10 absolute inset-0"></div>

        <!-- Content -->
        <div class="container mx-auto text-center text-white z-10 relative pb-10">
            <div class="animate-fade-in-up">
                <a href="#produk" class="btn btn-primary btn-lg shadow-md hover:shadow-lg transition duration-300">
                    Beli Sekarang!
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 w-full h-16 bg-gradient-to-t from-black to-transparent"></div>
    </div>


    <!-- Products Section -->
    <section id="produk" class="py-16 bg-gradient-to-r from-green-50 via-white to-green-100">
        <div class="container mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800">Produk Terbaru</h2>
                <p class="text-lg text-gray-600 mt-4">Temukan buku-buku menarik kami di bawah ini!</p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    @php
                        $harga = number_format($product['harga'], 0, ',', '.');
                        $stok = $product['stok'];
                    @endphp

                    <!-- Product Card -->
                    <div
                        class="card bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                        <!-- Product Image -->
                        <figure class="relative group">
                            <img src="{{ $product['gambar'] }}" alt="{{ $product['judul_buku'] }}"
                                class="w-full h-56 object-cover rounded-t-lg">
                            <div
                                class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-50 rounded-t-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="#"
                                    class="btn btn-primary text-white shadow-md hover:shadow-lg px-6 py-2 rounded-full transform hover:scale-105 transition duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </figure>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800">{{ $product['judul_buku'] }}</h3>
                            <p class="text-sm text-gray-500 mt-2">Pengarang: {{ $product['nama_pengarang'] }}</p>
                            <p class="text-lg text-green-600 font-medium mt-3">Rp. {{ $harga }}</p>
                            <p class="text-sm mt-2 {{ $stok == 0 ? 'text-red-500' : 'text-gray-600' }}">
                                Stok: {{ $stok == 0 ? 'Habis' : $stok }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


</x-main>
