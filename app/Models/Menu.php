<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamp = true;
    protected $table = 'menu';
    protected $guarded = ['id'];

    protected $fillable = [
        'kategori_id',
        'user_id',
        'nama_menu',
        'status',
        'deskripsi',
        'harga',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
