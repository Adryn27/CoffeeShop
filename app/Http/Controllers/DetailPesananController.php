<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $menu_id=$request->menu_id;
        $pesanan_id=$request->pesanan_id;
        $td=DetailPesanan::whereMenuId($menu_id)->wherePesananId($pesanan_id)->first();
        $pesanan=Pesanan::find($pesanan_id);
        if($td==null){
            $validatedData = $request->validate([
                'pesanan_id' => 'required',
                'menu_id' => 'required',
                'qty' => 'required|numeric',
                'catatan'=>'nullable',
                'subtotal' => 'required|numeric',
            ]);
            DetailPesanan::create($validatedData);

            // Update total pesanan
            $pesanan->total += $request->subtotal; // Menambahkan subtotal ke total pesanan
            $pesanan->save(); // Simpan perubahan pada pesanan
        }
        else{
            $validatedData = $request->validate([
                'qty' => 'required|numeric',
                'subtotal' => 'required|numeric',
            ]);
            // Mengupdate qty dan subtotal yang ada
            $td->qty += $request->qty;  // Menambah qty yang sudah ada
            $td->subtotal += $request->subtotal;  // Menambah subtotal yang sudah ada
            $td->save();  // Simpan perubahan

            // Update total pesanan
            $pesanan->total += $request->subtotal; // Menambahkan subtotal ke total pesanan
            $pesanan->save(); // Simpan perubahan pada pesanan
        }
        return redirect()->route('backend.pesanan.tambahTransaksi', ['id' => $pesanan_id])->with('success', 'Data Berhasil Ditambahkan');
    }

    public function delete(Request $request)
    {
        // Mengambil ID dari request
        $id = $request->id;

        // Mencari DetailPesanan berdasarkan ID
        $td = DetailPesanan::find($id);

        // Memeriksa apakah DetailPesanan ditemukan
        if (!$td) {
            return redirect()->back()->with('error', 'DetailPesanan tidak ditemukan');
        }

        // Mencari pesanan yang terkait dengan DetailPesanan
        $pesanan = Pesanan::find($td->pesanan_id);

        // Memeriksa apakah Pesanan ditemukan
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }

        // Mengurangi total pesanan dengan subtotal yang akan dihapus
        $newTotal = $pesanan->total - $td->subtotal;

        // Pastikan total pesanan tidak negatif
        if ($newTotal < 0) {
            $newTotal = 0;
        }

        // Update total pesanan
        $pesanan->update(['total' => $newTotal]);

        // Menghapus DetailPesanan
        $td->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function done($id)
    {
        $pesanan=Pesanan::find($id);
        $data=[
            'status'=>'selesai'
        ];
        $pesanan->update($data);
        return redirect('/pesanan');
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
        //
    }
}
