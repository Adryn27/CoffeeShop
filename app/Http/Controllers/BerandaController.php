<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function berandaBackend(){
        $menu=Menu::get();
        return view('backend.v_beranda.beranda', [
            'judul'=>'Halaman Beranda',
            'menu'=>$menu
        ]);
    }
}
