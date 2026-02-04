<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
