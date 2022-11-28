<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    protected $fillable = [
        'nama', 'id_makanan', 'tanggal_pembelian', 'jumlah_pembelian', 'jenis_pembayaran', 'jml_pembayaran', 'alamat'
    ];
}
