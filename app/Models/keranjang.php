<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['customer', 'buku', 'jumlah', 'total'];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'user');
    }

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'buku');
    }
}
