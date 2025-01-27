<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = [
            ['id_buku' => 1, 'judul_buku' => 'Judul Buku 1', 'gambar' => 'https://placehold.co/600x400', 'harga' => 50000, 'stok' => 10, 'nama_pengarang' => 'Pengarang 1'],
            ['id_buku' => 2, 'judul_buku' => 'Judul Buku 2', 'gambar' => 'https://placehold.co/600x400', 'harga' => 60000, 'stok' => 5, 'nama_pengarang' => 'Pengarang 2'],
            ['id_buku' => 3, 'judul_buku' => 'Judul Buku 3', 'gambar' => 'https://placehold.co/600x400', 'harga' => 70000, 'stok' => 0, 'nama_pengarang' => 'Pengarang 3'],
        ];
    
        return view('home.index', [
            'products' => $products,
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
