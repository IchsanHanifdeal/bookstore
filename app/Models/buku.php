<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    protected $fillable = ['judul_buku', 'pengarang', 'penerbit', 'kategori', 'stok', 'harga'. 'deskripsi', 'gambar'];

    public function pengarangs()
    {
        return $this->belongsTo(Pengarang::class, 'pengarang');
    }

    public function penerbits()
    {
        return $this->belongsTo(Penerbit::class, 'pengarang');
    }

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'pengarang');
    }
}
