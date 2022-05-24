<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kategori_id', 'penerbit_id', 'judul', 'isbn', 'deskripsi', 'pengarang', 'tahun_terbit', 'jumlah_buku', 'sampul', 'sampul_path'
    ];

    public function kategori() {
        return $this->belongsTo(kategori::class);
    }

    public function penerbit() {
        return $this->belongsTo(Penerbit::class);
    }

}
