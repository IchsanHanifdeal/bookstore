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
    public function index()
    {
        return view('dashboard.transaksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}
