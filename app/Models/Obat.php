<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaksi;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'kategori_obat',
        'harga_obat',
        'stok_obat',
        'tanggal_exp',
        'foto',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_obat');
    }
}
