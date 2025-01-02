<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $timestamp = true;
    protected $table = "kategori";
    protected $guarded = ['id'];

    protected $fillable = [
        'nama_kategori',
    ];
}
