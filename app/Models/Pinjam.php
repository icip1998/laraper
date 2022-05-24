<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pinjam_id', 'user_id', 'buku_id', 'status', 'tgl_pinjam', 'lama_pinjam', 'tgl_balik', 'tgl_kembali'
    ];

    public function buku() {
        return $this->belongsTo(Buku::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
