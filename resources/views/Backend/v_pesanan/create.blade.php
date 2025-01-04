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

                    <div class="row mt-1">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('backend.pesanan.index') }}">
                                <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
                            </a>
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
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="">Total belanja</label>
                        <input type="number" value="{{ $pesanan->total }}" readonly name="total_belanja" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" value="{{ request('dibayarkan') }}" name="dibayarkan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"> Hitung</button>
                </form>
                <hr>
                <div class="form-group">
                    <label for="">Uang Kembalian</label>
                    <input type="text" value="{{ number_format($kembalian), 0, ',', '.' }}" name="kembalian" class="form-control" readonly>
                </div>
            </div>
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
                    <div class="col-md-4">
                        <label><b>Nama Pelanggan</b></label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="pelanggan" class="form-control" value="{{ old('pelanggan', $pesanan->pelanggan) }}">
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                </div>
            </form>
            {{-- <div class="row mt-1">
                <div class="col-md-4">
                    <label><b>Nama Pelanggan</b></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="pelanggan" value="{{ old('pelanggan', $pesanan->pelanggan ?? '') }}">
                </div>
            </div> --}}
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
                    <button type="button" class="btn btn-info"><i class="fas fa-file"></i> Pending</button>
                </a>
                <a href="{{ route('detail-pesanan.selesai', [Request::segment(2)]) }}" class="btn btn-success"><i class="fas fa-check"></i> Selesai</a>
            </div>
        </div>
    </div>
</div>

@endsection