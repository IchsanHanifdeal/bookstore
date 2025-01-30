<x-main title="Detail Buku {{ $buku->judul_buku }}">
    <div class="container mx-auto p-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Gambar Buku -->
            <div class="flex justify-center items-center">
                <img src="{{ str_contains($buku->gambar, 'https://') ? $buku->gambar : asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul_buku }}"
                    class="max-w-full h-auto rounded-xl shadow-xl">
            </div>

            <!-- Detail Buku -->
            <div class="space-y-6">
                <h1 class="text-4xl font-semibold text-emerald-700">{{ $buku->judul_buku }}</h1>
                <p class="text-lg text-gray-700">
                    <strong class="text-emerald-600">Pengarang:</strong>
                    {{ $buku->pengarangs?->nama ?? 'Tidak diketahui' }}
                </p>
                <p class="text-lg text-gray-700">
                    <strong class="text-emerald-600">Penerbit:</strong>
                    {{ $buku->penerbits?->nama ?? 'Tidak diketahui' }}
                </p>
                <p class="text-lg text-gray-700">
                    <strong class="text-emerald-600">Kategori:</strong>
                    {{ $buku->kategoris?->nama_kategori ?? 'Tidak diketahui' }}
                </p>
                <p class="text-xl text-emerald-600 font-semibold">
                    Harga: Rp. {{ number_format($buku->harga, 0, ',', '.') }}
                </p>

                <p class="text-md text-gray-600">
                    <strong class="text-emerald-600">Deskripsi:</strong>
                    {{ $buku->deskripsi }}
                </p>

                <!-- Tombol Tambahkan ke Keranjang -->
                <div class="flex justify-center mt-8">
                    <button id="addToCartButton" data-judul="{{ $buku->judul_buku }}" data-id="{{ $buku->id }}"
                        data-harga="{{ $buku->harga }}"
                        class="btn btn-primary btn-lg px-8 py-3 rounded-full font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 transform transition-all duration-300 ease-in-out hover:scale-105 shadow-xl hover:shadow-2xl">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </div>
        </div>

        <!-- Bagian Buku Terkait -->
        <div class="mt-12">
            <h2 class="text-3xl font-semibold text-emerald-700">Buku Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
                @foreach ($relatedBooks as $related)
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ str_contains($related->gambar, 'https://') ? $related->gambar : asset('storage/' . $related->gambar) }}" alt="{{ $related->judul_buku }}"
                            class="w-full h-64 object-cover rounded-lg">
                        <h3 class="text-xl font-semibold mt-4 text-gray-800">{{ $related->judul_buku }}</h3>
                        <p class="text-sm text-gray-600">{{ $related->pengarangs?->nama ?? 'Tidak diketahui' }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-lg font-semibold text-emerald-600">
                                Rp. {{ number_format($related->harga, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('detail_buku', ['judul_buku' => $related->judul_buku]) }}"
                                class="text-emerald-600 hover:text-emerald-700">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addToCartButton = document.getElementById("addToCartButton");

            // Cek apakah ada pesan sukses di localStorage setelah refresh
            if (localStorage.getItem("cartSuccess")) {
                showToast("Buku berhasil ditambahkan ke keranjang!", "border-green-500");
                localStorage.removeItem("cartSuccess"); // Hapus status setelah ditampilkan
            }

            if (addToCartButton) {
                addToCartButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Disable tombol setelah ditekan
                    addToCartButton.disabled = true;
                    addToCartButton.classList.add("opacity-50", "cursor-not-allowed");
                    addToCartButton.innerText = "Menambahkan...";

                    const judulBuku = addToCartButton.getAttribute("data-judul");
                    const bukuId = addToCartButton.getAttribute("data-id");
                    const harga = addToCartButton.getAttribute("data-harga");
                    const jumlah = 1;
                    const total = jumlah * harga;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    fetch("/get-customer-id", {
                            method: "GET",
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            const customerId = data.customer_id;

                            fetch(`/add-to-cart/${judulBuku}/${bukuId}`, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "Accept": "application/json",
                                        "X-CSRF-TOKEN": csrfToken
                                    },
                                    body: JSON.stringify({
                                        customer_id: customerId,
                                        buku_id: bukuId,
                                        jumlah: jumlah,
                                        total: total
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        localStorage.setItem("cartSuccess",
                                        "true"); 
                                        location.reload(); 
                                    } else {
                                        showToast("Gagal menambahkan buku ke keranjang, anda belum login!",
                                            "border-red-500");
                                        addToCartButton.disabled = false;
                                        addToCartButton.classList.remove("opacity-50",
                                            "cursor-not-allowed");
                                        addToCartButton.innerText = "Tambahkan ke Keranjang";
                                    }
                                })
                                .catch(error => {
                                    console.error("Terjadi kesalahan:", error);
                                    showToast("Gagal menambahkan buku ke keranjang.",
                                        "border-red-500");
                                    addToCartButton.disabled = false;
                                    addToCartButton.classList.remove("opacity-50",
                                        "cursor-not-allowed");
                                    addToCartButton.innerText = "Tambahkan ke Keranjang";
                                });
                        })
                        .catch(error => {
                            console.error("Gagal mendapatkan customer ID:", error);
                            showToast("Gagal mendapatkan customer ID.", "border-red-500");
                            addToCartButton.disabled = false;
                            addToCartButton.classList.remove("opacity-50", "cursor-not-allowed");
                            addToCartButton.innerText = "Tambahkan ke Keranjang";
                        });
                });
            }
        });
    </script>
</x-main>
