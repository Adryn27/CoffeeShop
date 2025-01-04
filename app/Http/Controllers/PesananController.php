<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesan = Pesanan::orderBy('id', 'asc')->get();
        return view('backend.v_pesanan.index', [
            'judul' => 'Data Pesanan',
            'pesan' => $pesan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validatedData['user_id'] = Auth::user()->id;
        
        $pesanan=Pesanan::create($validatedData);
        return redirect()->route('backend.pesanan.tambahTransaksi', ['id' => $pesanan->id]);
    }

    public function tambahTransaksi(string $id)
    {
        $menu=Menu::orderBy('kategori_id', 'asc')->get();
        
        $menu_id=request('menu_id');
        $detail=Menu::find($menu_id);

        $pesandetail=DetailPesanan::wherePesananId($id)->get();

        $act=request('act');
        $qty=request('qty');
        if($act=='min'){
            if($qty<=1){
                $qty=1;
            }
            else{
                $qty=$qty - 1;
            }
        }
        else{
            $qty=$qty + 1;
        }

        $subtotal=0;
        if($detail){
            $subtotal=$qty*$detail->harga;
        }

        $pesanan=Pesanan::find($id);
        $dibayarkan=request('dibayarkan');
        $kembalian=$dibayarkan-$pesanan->total;

        return view('backend.v_pesanan.create', [
            'judul'=>'Tambah Pesanan',
            'menu'=>$menu,
            'detail'=>$detail,
            'qty'=>$qty,
            'pesandetail'=>$pesandetail,
            'subtotal'=>$subtotal,
            'pesanan'=>$pesanan,
            'kembalian'=>$kembalian
        ]);
    }


    public function delete($id)
    {
        // Mencari Pesanan berdasarkan ID
        $pesanan = Pesanan::find($id);

        // Memastikan Pesanan ditemukan
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }

        // Menghapus DetailPesanan terkait pesanan
        $pesanan->detailPesanan()->delete();  // Menghapus semua detail pesanan yang terkait dengan pesanan ini

        // Menghapus Pesanan
        $pesanan->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('backend.pesanan.index')->with('success', 'Pesanan Berhasil Dihapus');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // Validasi input
        $validatedData = $request->validate([
            'pelanggan' => 'required|string|max:255',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'pelanggan' => $validatedData['pelanggan'],
        ]);
        return redirect()->back()->with('success', 'Pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
