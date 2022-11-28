<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'poster',
        'nama', 
        'tanggal',
        'deskripsi',
        'lokasi',
        'harga',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
