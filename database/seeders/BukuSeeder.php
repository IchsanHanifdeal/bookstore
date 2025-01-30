<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $penerbits = [
            ['nama' => 'Penerbit A', 'alamat' => 'Jl. A No. 1', 'email' => 'penerbita@example.com', 'telp' => '081234567890'],
            ['nama' => 'Penerbit B', 'alamat' => 'Jl. B No. 2', 'email' => 'penerbitb@example.com', 'telp' => '081234567891'],
        ];
        DB::table('penerbits')->insert($penerbits);

        $kategoris = [
            ['nama_kategori' => 'Fiksi'],
            ['nama_kategori' => 'Non-Fiksi'],
            ['nama_kategori' => 'Edukasi'],
        ];
        DB::table('kategoris')->insert($kategoris);

        $pengarangs = [
            ['nama' => 'Pengarang A', 'alamat' => 'Jl. X No. 1', 'email' => 'pengaranga@example.com', 'telp' => '081234567892'],
            ['nama' => 'Pengarang B', 'alamat' => 'Jl. Y No. 2', 'email' => 'pengarangb@example.com', 'telp' => '081234567893'],
        ];
        DB::table('pengarangs')->insert($pengarangs);

        $penerbitIds = DB::table('penerbits')->pluck('id')->toArray();
        $kategoriIds = DB::table('kategoris')->pluck('id')->toArray();
        $pengarangIds = DB::table('pengarangs')->pluck('id')->toArray();

        $bukus = [];
        for ($i = 1; $i <= 10; $i++) {
            $bukus[] = [
                'judul_buku' => 'Buku ' . $i,
                'pengarang' => $pengarangIds[array_rand($pengarangIds)],
                'penerbit' => $penerbitIds[array_rand($penerbitIds)],
                'kategori' => $kategoriIds[array_rand($kategoriIds)],
                'stok' => rand(5, 20),
                'harga' => rand(50000, 200000),
                'deskripsi' => 'Deskripsi Buku ' . $i,
                'gambar' => 'https://placehold.co/600x400',
            ];
        }
        DB::table('bukus')->insert($bukus);
    }
}
