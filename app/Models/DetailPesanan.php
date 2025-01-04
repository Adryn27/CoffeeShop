<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    public $timestamp = true;
    protected $table = 'detailpesanan';
    protected $guarded = ['id'];

    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'catatan',
        'qty',
        'subtotal',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
