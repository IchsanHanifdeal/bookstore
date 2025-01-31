<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\keranjang;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedDay = $request->input('hari');
        $selectedMonth = $request->input('bulan');
        $selectedYear = $request->input('tahun');

        $hariIndonesia = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7
        ];

        $query = Transaksi::query();

        if ($selectedDay && isset($hariIndonesia[$selectedDay])) {
            $query->whereRaw('DAYOFWEEK(tanggal) = ?', [$hariIndonesia[$selectedDay]]);
        }

        if ($selectedMonth) {
            $query->whereMonth('tanggal', $selectedMonth);
        }

        if ($selectedYear) {
            $query->whereYear('tanggal', $selectedYear);
        }

        $transaksi = $query->get();

        $jumlah_transaksi_tahun_ini = Transaksi::whereYear('tanggal', now()->year)->sum('total');
        $jumlah_transaksi_bulan_ini = Transaksi::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->sum('total');
        $jumlah_transaksi_hari_ini = Transaksi::whereDate('tanggal', now()->format('Y-m-d'))->sum('total');

        $jumlah_transaksi = Transaksi::count();
        $jumlah_menunggu_persetujuan = Transaksi::where('validasi', 'menunggu_validasi')->count();
        $jumlah_transaksi_dikonfirmasi = Transaksi::where('validasi', 'diterima')->count();
        $jumlah_transaksi_ditolak = Transaksi::where('validasi', 'ditolak')->count();

        return view('dashboard.transaksi', [
            'jumlah_transaksi' => $jumlah_transaksi,
            'jumlah_menunggu_persetujuan' => $jumlah_menunggu_persetujuan,
            'jumlah_transaksi_dikonfirmasi' => $jumlah_transaksi_dikonfirmasi,
            'jumlah_transaksi_ditolak' => $jumlah_transaksi_ditolak,
            'jumlah_transaksi_tahun_ini' => $jumlah_transaksi_tahun_ini,
            'jumlah_transaksi_bulan_ini' => $jumlah_transaksi_bulan_ini,
            'jumlah_transaksi_hari_ini' => $jumlah_transaksi_hari_ini,
            'transaksi' => $transaksi,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function history_transaksi()
    {
        $user = Auth::user();
        $customer = Customer::where('user', $user->id)->first();

        if (!$customer) {
            return redirect()->route('home')->with('error', 'Customer tidak ditemukan');
        }

        $transaksi = Transaksi::where('customer', $customer->id)->with('bukus')->orderBy('tanggal', 'desc')->get();

        return view('home.history', compact('transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();

            $customer = Customer::where('user', $user->id)->first(); // Ambil satu data customer

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Customer tidak ditemukan!'], 400);
            }

            $cartItems = Keranjang::where('customer', $customer->id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Keranjang kosong!'], 400);
            }

            $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

            foreach ($cartItems as $item) {
                Transaksi::create([
                    'customer' => $customer->id,
                    'buku' => $item->buku,
                    'tanggal' => now(),
                    'jumlah' => $item->jumlah,
                    'total' => $item->total,
                    'bukti_transaksi' => $filePath,
                    'validasi' => 'menunggu_validasi',
                ]);
            }

            Keranjang::where('customer', $customer->id)->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikirim!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat menyimpan transaksi: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function terima(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $buku = $transaksi->bukus;

        // Memeriksa apakah stok buku cukup
        if ($buku->stok < $transaksi->jumlah) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Stok buku tidak cukup.'
            ]);
        }

        // Mengurangi stok buku
        $buku->stok -= $transaksi->jumlah;
        $buku->save();

        // Update status transaksi menjadi diterima
        $transaksi->validasi = 'diterima';
        $transaksi->save();

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Transaksi diterima dan stok buku telah diperbarui.'
        ]);
    }
    public function tolak(Request $request, $id)
    {
        $peminjaman = Transaksi::findOrFail($id);

        // Update status transaksi menjadi ditolak
        $peminjaman->update([
            'validasi' => 'ditolak',
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Peminjaman ditolak.'
        ]);
    }
}
