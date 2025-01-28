<?php

namespace App\Http\Controllers;

use App\Models\penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.penerbit', [
            'penerbit' => Penerbit::all(),
            'penerbit_terbaru' => Penerbit::orderBy('created_at', 'desc')->first(),
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telp' => 'required|string|max:255',
        ]);

        Penerbit::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Penerbit berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penerbit $penerbit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telp' => 'required|string|max:255',
        ]);

        $penerbit = penerbit::findOrFail($id);

        $penerbit->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Kategori berhasil diperbarui.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = penerbit::findOrFail($id);

        $kategori->delete();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Penerbit berhasil dihapus.',
        ]);
    }
}
