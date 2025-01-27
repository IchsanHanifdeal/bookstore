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
        //
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
    public function update(Request $request, pengarang $pengarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengarang $pengarang)
    {
        //
    }
}
