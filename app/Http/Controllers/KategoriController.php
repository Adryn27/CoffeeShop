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
        return view('backend.v_kategori.index', [
            'judul' => 'kategori',
            'index' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_kategori.index', [
            'judul' => 'kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_kategori' => 'requireed|max:255|unique:kategori'
        ];

        $validatedData = $request->validate($rules);
        kategori::create($validatedData);
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil tersimpan');
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
        $kategori = kategori::find($id);
        return view('backend.v_kategori.index', [
            'judul' => 'kategori',
            'edit' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = kategori::find($id);
        $rules = [
            'nama_kategori' => 'requireed|max:255|unique:kategori'
        ];

        $validatedData = $request->validate($rules);
        $kategori->update($validatedData);
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = kategori::find($id);
        $kategori->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil dihapus');
    }
}
