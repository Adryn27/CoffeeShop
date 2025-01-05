<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ProsesPesananController extends Controller
{
    public function index()
    {
        $pesan = Pesanan::orderBy('created_at', 'asc')->where('status', 'dibayar')->where('proses', 'pending')->get();
        return view('backend.v_pesanan.proses', [
            'judul' => 'Proses Pesanan',
            'pesan' => $pesan
        ]);
    }

    public function show(string $id)
    {
        // Ambil detail pesanan berdasarkan pesanan_id
        $pesandetail = DetailPesanan::where('pesanan_id', $id)->get();

        // Jika pesanan tidak ditemukan, redirect atau beri pesan error
        if ($pesandetail->isEmpty()) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $pesanan = Pesanan::findOrFail($id);

        return view('backend.v_pesanan.view', [
            'judul' => 'Detail Pesanan Pelanggan',
            'pesan' => $pesandetail,
            'pesanan' => $pesanan
        ]);
    }

    public function done($id)
    {
        $pesanan=Pesanan::find($id);
        $data=[
            'proses'=>'selesai'
        ];
        $pesanan->update($data);
        return redirect('/proses');
    }

}
