<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public $timestamp = true;
    protected $table = 'pesanan';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'pelanggan',
        'status',
        'proses',
        'layanan',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
