<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $timestamps = true;
    protected $table = 'kategori';
    protected $guarded = ['id'];
    // protected $fillable = ['nama_kategori'];
}
