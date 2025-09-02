<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori;
use App\Models\penerbit;
use App\Models\pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->input('kategori', ''));

        $buku = Buku::with(['pengarangs', 'penerbits', 'kategoris'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('judul_buku', 'like', "%{$q}%")
                        ->orWhere('deskripsi', 'like', "%{$q}%")
                        ->orWhere('stok', 'like', "%{$q}%")
                        ->orWhere('harga', 'like', "%{$q}%");
                })
                    ->orWhereHas('pengarangs', fn($r) => $r->where('nama', 'like', "%{$q}%"))
                    ->orWhereHas('penerbits', fn($r) => $r->where('nama', 'like', "%{$q}%"))
                    ->orWhereHas('kategoris', fn($r) => $r->where('nama_kategori', 'like', "%{$q}%"));
            })
            ->orderBy('stok', 'asc')
            ->get();

        return view('dashboard.buku', [
            'buku'         => $buku,
            'buku_terbaru' => Buku::orderBy('created_at', 'desc')->first(),
            'pengarang'    => Pengarang::all(),
            'penerbit'     => Penerbit::all(),
            'kategori'     => Kategori::all(),
            'search'       => $q,
            'total_buku'   => Buku::all()->count(),
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
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['judul_buku', 'pengarang', 'penerbit', 'kategori', 'stok', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        Buku::create($data);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Buku berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $buku = Buku::findOrFail($id);
        $data = $request->only(['judul_buku', 'pengarang', 'penerbit', 'kategori', 'stok', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Buku berhasil diperbarui.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Buku::findOrFail($id);

        $kategori->delete();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Buku berhasil dihapus.',
        ]);
    }
}
