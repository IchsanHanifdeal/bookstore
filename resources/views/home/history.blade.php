<x-main title="History" class="w-full">
    <div class="hero h-[500px] bg-center text-center relative flex flex-col justify-end overflow-hidden">
        <img src="../images/caro-4.jpg" alt="Background Image" class="absolute inset-0 w-full h-full object-cover z-0">
        <div class="hero-overlay bg-black bg-opacity-20 absolute inset-0"></div>
        <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-black to-transparent"></div>
    </div>

    <div class="container mx-auto my-10 p-6 bg-white shadow-xl rounded-xl">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Daftar Transaksi</h2>

        <div class="overflow-x-auto">
            <table class="table w-full border-collapse">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="p-3 text-left">#</th>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Judul Buku</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Total</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $key => $item)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="p-3">{{ $key + 1 }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            <td class="p-3">{{ $item->bukus->judul_buku ?? 'Tidak diketahui' }}</td>
                            <td class="p-3 text-center">{{ $item->jumlah }}</td>
                            <td class="p-3 text-center">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                @if ($item->validasi == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($item->validasi == 'menunggu_validasi')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-error">Ditolak</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if ($item->bukti_transaksi)
                                    <a href="{{ asset('storage/' . $item->bukti_transaksi) }}" target="_blank"
                                        class="btn btn-sm btn-outline btn-primary">Lihat</a>
                                @else
                                    <span class="text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-main>
