<?php

namespace App\Http\Controllers;

use App\Models\pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pengarang', [
            'pengarang' => Pengarang::all(),
            'pengarang_terbaru' => Pengarang::orderBy('created_at', 'desc')->first(),
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

        Pengarang::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Pengarang berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(pengarang $pengarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengarang $pengarang)
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

        $pengarang = Pengarang::findOrFail($id);

        $pengarang->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Pengarang berhasil diperbarui.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = pengarang::findOrFail($id);

        $kategori->delete();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Pengarang berhasil dihapus.',
        ]);
    }
}
