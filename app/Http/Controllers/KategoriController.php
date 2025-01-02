<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('Backend.v_kategori.index', [
            'judul' => 'kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.v_kategori.create', [
            'judul' => 'kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|max:255|unique:kategori'
        ];

        $validatedData = $request->validate($rules);
        Kategori::create($validatedData);
        
        return redirect()->route('backend.kategori.index')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = kategori::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil dihapus');
    }
}
