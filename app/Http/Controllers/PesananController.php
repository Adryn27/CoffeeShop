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
        $pesan = Pesanan::orderBy('id', 'asc')->where('proses','pending')->get();
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

    // public function tambahTransaksi(string $id)
    // {
    //     $menu=Menu::orderBy('kategori_id', 'asc')->get();
        
    //     $menu_id=request('menu_id');
    //     $detail=Menu::find($menu_id);

    //     $pesandetail=DetailPesanan::wherePesananId($id)->get();

    //     $act=request('act');
    //     $qty=request('qty');
    //     if($act=='min'){
    //         if($qty<=1){
    //             $qty=1;
    //         }
    //         else{
    //             $qty=$qty - 1;
    //         }
    //     }
    //     else{
    //         $qty=$qty + 1;
    //     }

    //     $subtotal=0;
    //     if($detail){
    //         $subtotal=$qty*$detail->harga;
    //     }

    //     $pesanan=Pesanan::find($id);
    //     $dibayarkan=request('dibayarkan');
    //     $kembalian=$dibayarkan-$pesanan->total;

    //     return view('backend.v_pesanan.create', [
    //         'judul'=>'Tambah Pesanan',
    //         'menu'=>$menu,
    //         'detail'=>$detail,
    //         'qty'=>$qty,
    //         'pesandetail'=>$pesandetail,
    //         'subtotal'=>$subtotal,
    //         'pesanan'=>$pesanan,
    //         'kembalian'=>$kembalian
    //     ]);
    // }

    public function tambahTransaksi(string $id)
    {
        $menu = Menu::orderBy('kategori_id', 'asc')->get();
    
        // Ambil menu_id dan detail menu
        $menu_id = request('menu_id');
        $detail = Menu::find($menu_id);
    
        // Ambil detail pesanan berdasarkan pesanan_id
        $pesandetail = DetailPesanan::wherePesananId($id)->get();
    
        // Aksi untuk tambah/kurang qty
        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            $qty = max($qty - 1, 1);  // Pastikan qty tidak kurang dari 1
        } else {
            $qty += 1;
        }
    
        // Hitung subtotal
        $subtotal = 0;
        if ($detail) {
            $subtotal = $qty * $detail->harga;
        }
    
        $pesanan = Pesanan::find($id);
    
        return view('backend.v_pesanan.create', [
            'judul' => 'Tambah Pesanan',
            'menu' => $menu,
            'detail' => $detail,
            'qty' => $qty,
            'pesandetail' => $pesandetail,
            'subtotal' => $subtotal,
            'pesanan' => $pesanan,
        ]);
    }
    

    public function hitungPembayaran(Request $request, $id)
    {
        // Ambil pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);

        // Ambil nilai dibayarkan dan hitung kembalian
        $dibayarkan = $request->dibayarkan;
        $total = $pesanan->total;
        
        // Jika dibayarkan kurang dari total, set kembalian menjadi 0
        if ($dibayarkan < $total) {
            $kembalian = 0;
        } else {
            $kembalian = $dibayarkan - $total;  // Hitung kembalian
        }

        // Perbarui status pesanan menjadi 'dibayar'
        $pesanan->status = 'dibayar';
        $pesanan->save();

        // Redirect kembali dengan session data
        return back()->with([
            'kembalian' => $kembalian, 
            'dibayarkan'=>$dibayarkan,
            'pesanan' => $pesanan, // Mengirim pesanan kembali jika diperlukan
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

    public function form()
    {
        $pesan = Pesanan::orderBy('created_at', 'desc')->where('status', 'dibayar')->where('proses', 'selesai')->get();
        return view('backend.v_pesanan.form', [
            'judul' => 'Transaksi',
            'pesan' => $pesan
        ]);
    }

    public function cetak(Request $request)
    {
        
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
            'layanan'=>'required'
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'pelanggan' => $validatedData['pelanggan'],
            'layanan'=>$validatedData['layanan']
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
