<x-main title="Home" class="w-full">
    <!-- Hero Section -->
    <div class="hero h-[600px] bg-center text-center relative flex flex-col justify-end overflow-hidden">
        <!-- Background Image -->
        <img src="../images/caro-4.jpg" alt="Background Image" class="absolute inset-0 w-full h-full object-cover z-0 transform hover:scale-105 transition duration-700 ease-in-out">

        <!-- Overlay -->
        <div class="hero-overlay bg-gradient-to-t from-black via-transparent to-transparent absolute inset-0"></div>

        <!-- Content -->
        <div class="container mx-auto text-center text-white z-10 relative pb-20">
            <div class="animate-fade-in-up">
                <a href="#produk" class="btn btn-primary btn-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-110 bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600">
                    Beli Sekarang!
                </a>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <section id="produk" class="py-20 bg-gradient-to-r from-green-50 via-white to-green-100">
        <div class="container mx-auto max-w-6xl px-4">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">Produk Terbaru</h2>
                <p class="text-xl text-gray-600 mt-4">Temukan buku-buku menarik kami di bawah ini!</p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($buku as $i)
                    <div class="card bg-white shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 flex flex-col h-full hover:shadow-2xl">
                        <!-- Product Image -->
                        <figure class="relative group flex-shrink-0">
                            <img src="{{ str_contains($i->gambar, 'https://') ? $i->gambar : asset('storage/' . $i->gambar) }}"
                                alt="{{ $i->judul_buku }}" class="w-full h-64 object-cover rounded-t-lg transform hover:scale-110 transition duration-500 ease-in-out">
                            <div class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-50 rounded-t-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('detail_buku', $i->judul_buku) }}"
                                    class="btn btn-primary text-white shadow-md hover:shadow-lg px-6 py-2 rounded-full transform hover:scale-105 transition duration-300 bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600">
                                    Lihat Detail
                                </a>
                            </div>
                        </figure>

                        <!-- Product Info -->
                        <div class="p-6 flex-grow">
                            <h3 class="text-2xl font-semibold text-gray-800 hover:text-green-600 transition duration-300">{{ $i->judul_buku }}</h3>
                            <p class="text-sm text-gray-500 mt-2">Pengarang: {{ $i->pengarangs->nama }}</p>
                            <p class="text-lg text-green-600 font-medium mt-3">Rp. {{ number_format($i->harga, 0, ',', '.') }}</p>
                            <p class="text-sm mt-2 {{ $i->stok == 0 ? 'text-red-500' : 'text-gray-600' }}">
                                Stok: {{ $i->stok == 0 ? 'Habis' : $i->stok }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-main>