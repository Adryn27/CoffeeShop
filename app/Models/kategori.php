<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    public $timestamps = false;
    protected $table = "kategori";
    protected $guarded = ['id'];
    protected $fillable = ['nama_kategori']; 
}
