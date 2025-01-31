<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['customer', 'buku', 'tanggal', 'jumlah', 'total', 'bukti_transaksi', 'validasi'];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer');
    }

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'buku');
    }
}
