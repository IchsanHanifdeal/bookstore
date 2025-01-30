<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.index', [
            'buku' => buku::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($judul_buku)
    {
        $buku = Buku::where('judul_buku', $judul_buku)->first();

        if (!$buku) {
            return redirect()->route('home')->with('error', 'Book not found');
        }

        $relatedBooks = Buku::where('kategori', $buku->kategori)
            ->where('id', '!=', $buku->id)
            ->take(4)
            ->get();

        return view('home.detail', [
            'buku' => $buku,
            'relatedBooks' => $relatedBooks
        ]);
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
