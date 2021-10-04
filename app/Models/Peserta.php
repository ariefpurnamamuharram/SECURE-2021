<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pembelian', 'jam_pembelian', 'nama', 'pekerjaan', 'instansi', 'email', 'nomor_telepon', 'jenis_tiket', 'deskripsi_tiket', 'yang_mendaftarkan'
    ];
}
