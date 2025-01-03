<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public $timestamp = true;
    protected $table = 'menu';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'nama_kasir',
        'status',
        'subtotal',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
