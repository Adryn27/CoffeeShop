<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuPelangganController extends Controller
{
    public function index(request $request)
    {
        $kategori=Kategori::get();
        $menu=Menu::orderby('status','asc')->when($request->search, function ($query, $search) {
            return $query->where('nama_menu', 'like', "%{$search}%");})->get();
        $content=Menu::get();
        return view('Frontend.v_menu.index', [
            'judul'=>'Menu',
            'menu'=>$menu,
            'content'=>$content,
            'kategori'=>$kategori,
        ]);
    }
}
