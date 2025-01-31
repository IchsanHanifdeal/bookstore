<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\customer;
use Illuminate\Http\Request;
use App\Models\transaksi;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_per_bulan = Transaksi::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $bulan_nama = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $bulan_labels = array_map(fn($bulan) => $bulan_nama[$bulan], array_keys($data_per_bulan->toArray()));

        $transaksi_terbaru = Transaksi::with(['customers', 'bukus']) 
            ->latest('tanggal')
            ->take(10)
            ->get();

        return view('dashboard.index', [
            'jumlah_buku' => Buku::count(),
            'jumlah_customer' => Customer::count(),
            'jumlah_transaksi' => Transaksi::count(),
            'jumlah_pendapatan' => Transaksi::sum('total'),
            'data_transaksi' => json_encode(array_values($data_per_bulan->toArray())),
            'bulan_labels' => json_encode($bulan_labels),
            'transaksi_terbaru' => $transaksi_terbaru
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
