@extends('backend.v_layout.app')
@section('content')

<div class="row p-2">
    <div class="col-12">
        <div class="card mt-3">
          <div class="card-header">
            <h3><b>{{ $judul }}</b></h3>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mt-1">
                        <div class="col-md-1">
                            <label><b>Layanan</b></label>
                        </div>
                        <div class="col-md-4">
                            <select name="layanan" class="form-control @error('layanan') is-invalid @enderror">
                                <option value="" {{ old('layanan', $pesanan->layanan) == '' ? 'selected' : '' }}>- Pilih Layanan -</option>
                                <option value="dinein" {{ old('layanan', $pesanan->layanan) == 'dinein' ? 'selected' : '' }}>Dine-In</option>
                                <option value="takeaway" {{ old('layanan', $pesanan->layanan) == 'takeaway' ? 'selected' : '' }}>Takeaway</option>
                            </select>
                            @error('layanan')
                                <div class="invalid-feedback alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label><b>Nama Pelanggan</b></label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pelanggan" class="form-control @error('pelanggan') is-invalid @enderror" value="{{ old('pelanggan', $pesanan->pelanggan) }}">
                            @error('pelanggan')
                                <div class="invalid-feedback alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row mt-1">
                    <div class="col-md-4">
                        <label><b>Kode Menu</b></label>
                    </div>
                    <div class="col-md-8">
                        <form method="GET" action="#">
                            <div class="d-flex">
                                <select name="menu_id" class="form-control" id="">
                                    <option value="">- {{ isset($detail) ? $detail->nama_menu: 'Pilih Menu' }} -</option>
                                    @foreach ($menu as $row)
                                        <option value="{{ $row->id }}">{{ $row->id. ' - '.$row->nama_menu}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <form action="{{ route('detail.pesanan') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ Request::segment(2) }}" name="pesanan_id">
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label><b>Nama Menu</b></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($detail) ? $detail->nama_menu: '' }}" disabled class="form-control" name="menu_id">
                            <input type="hidden" value="{{ isset($detail) ? $detail->id: '' }}" name="menu_id">
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label><b>Harga Satuan</b></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($detail) ? $detail->harga: '' }}" readonly class="form-control" name="harga">
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label><b>Qty</b></label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <a href="?menu_id={{ request('menu_id') }}&act=min&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                <input type="number" value="{{ $qty }}" class="form-control" name="qty">
                                <a href="?menu_id={{ request('menu_id') }}&act=plus&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label><b>Catatan</b></label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" name="catatan"></textarea>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label><b>Subtotal</b></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" value="{{ $subtotal }}" name="subtotal" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#kembaliModal">
                                <i class="fas fa-arrow-left"> Kembali</i>
                            </button>
                            {{-- <a href="{{ route('backend.pesanan.index') }}">
                                <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
                            </a> --}}
                            <button type="submit" class="btn btn-primary">Tambah <i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Metode Pembayaran</label>
                    </div>
                    <div class="col-md-7">
                        <button class="btn btn-success"><i class="fa fa-money-bill"> Cash</i></button>
                        <button class="btn btn-primary"><i class="fa fa-credit-card"> Bank</i></button>
                        <button class="btn btn-warning"><i class="fa fa-wallet"> Wallet</i></button>
                    </div>
                </div>
                <hr>
                <form action="{{ route('pesanan.hitung', $pesanan->id) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="">Total belanja</label>
                        <input type="number" value="{{ $pesanan->total }}" readonly name="total_belanja" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" value="{{ old('dibayarkan', session('dibayarkan')) }}" name="dibayarkan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"> Hitung</button>
                </form>
                <hr>
                <div class="form-group">
                    <label for="">Uang Kembalian</label>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" value="{{ number_format(session('kembalian'), 0, ',', '.') }}" name="kembalian" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <button onclick="printStruk()" class="btn btn-success" type="submit"><i class="fas fa-file-pdf"> Struk</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-hover mt-3">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                                <th>Catatan</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesandetail as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->menu->nama_menu }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->catatan }}</td>
                                <td>Rp {{ number_format($row->subtotal), 0, ',', '.' }}</td>
                                <td>
                                    <form action="{{ route('detail-pesanan.delete', ['id' => $row->id]) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                </div>
                <div class="col-md-12 text-center">
                    <a href="{{ route('backend.pesanan.index') }}">
                        <button type="button" class="btn btn-success"><i class="fas fa-file"></i> Simpan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="kembaliModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Pass the pesanan_id to the route via the action URL -->
            <form action="{{ route('pesanan.destroy', ['id' => Request::segment(2)]) }}" method="POST">
                @csrf
                @method('DELETE') <!-- Add the DELETE method for resource deletion -->
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Apakah Anda Yakin Ingin Kembali?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Memilih "Kembali" akan menghapus pesanan ini. 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="struk" class="d-none">
    <style>
        .struk-container {
            width: 300px;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Courier New', Courier, monospace;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .struk-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .struk-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .struk-header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .struk-header img {
            max-width: 30px; 
            margin-bottom: 10px;
        }

        
        .struk-info {
            margin-bottom: 20px;
        }
        
        .struk-info p {
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .struk-info .bold {
            font-weight: bold;
        }

        .struk-detail {
            margin-bottom: 20px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
        }
        
        .struk-detail p{
            text-align: center;
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .struk-detail table {
            width: 100%;
            border-collapse: collapse;
        }

        .struk-detail th,
        .struk-detail td {
            padding: 8px 0;
            text-align: left;
            font-size: 14px;
        }

        .struk-detail th {
            text-align: center;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
        }
        
        .struk-bawah {
            display: flex;
            justify-content: space-between; 
            align-items: center;           
        }

        .kiri {
            font-weight: bold;
            font-size: 14px;
        }

        .kanan {
            font-size: 14px;
        }

        .struk-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        .struk-footer p {
            margin: 5px 0;
            color: #666;
        }
        @media print {
            .struk-container {
                width: 250px;
                padding: 10px;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .struk-header h1 {
                font-size: 22px;
            }

            .struk-footer {
                font-size: 10px;
            }
        }
    </style>
    <div class="struk-container">
        <div class="struk-header">
            <img src="{{ asset('Template/logo/logo64.png') }}">
            <h1>KopiKampus</h1>
            <p>Jl. Cut Mutia No.88</p>
        </div>
        <div class="struk-info">  
            <p><span class="bold">NoPsn :</span>{{ $pesanan->id }}</p>
            <p><span class="bold">Waktu :</span>{{ $pesanan->created_at }} </p>
            <p><span class="bold">Kasir :</span>{{ $pesanan->user->nama }}</p>
        </div>
        <div class="struk-detail">
            <p>{{ $pesanan->pelanggan}} - ({{ $pesanan->layanan }})</p>
            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Qty</th>
                        <th>Catatan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesandetail as $row)
                    <tr>
                        <td>{{ $row->menu->nama_menu }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->catatan }}</td>
                        <td>Rp{{ number_format($row->subtotal), 0, ',', '.' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="struk-bawah">
            <div class="kiri">Total</div>
            <div class="total">Rp{{ number_format($pesanan->total), 0, ',', '.' }}</div>
        </div>
        <div class="struk-bawah">
            <div class="kiri">Bayar</div>
            <div class="kanan">Rp{{ number_format(session('dibayarkan')), 0, ',', '.' }}</div>
        </div>
        <div class="struk-bawah">
            <div class="kiri">Kembalian</div>
            <div class="kanan">Rp{{ number_format(session('kembalian')), 0, ',', '.' }}</div>
        </div>
        <div class="struk-footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <hr>
            <p>KopiKampus, Teman yang Tepat di Setiap Langkah</p>
        </div>
    </div>
</div>

<script>
    function printStruk(){
        var struk=document.getElementById("struk").innerHTML;

        var print=document.createElement('iframe');
        print.style.display='none';
        document.body.appendChild(print);
        print.contentDocument.write(struk);
        print.contentWindow.print();
        document.body.removeChild(print);
    }
</script>

@endsection