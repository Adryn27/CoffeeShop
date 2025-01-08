@extends('backend.v_layout.app')
@section('content')

<style>
    input[type="checkbox"] {
        width: 25px; 
        height: 25px; 
        margin: 5px; 
    }
</style>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3><b>{{ $judul }}</b></h3>
          </div>
        <div class="card-body">
            <form action="{{ route('backend.proses.show', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mt-1">
                    <div class="col-md-2">
                        <label><b>Layanan</b></label>
                    </div>
                    <div class="col-md-4">
                        <select name="layanan" class="form-control" disabled>
                            <option value="" {{ old('layanan', $pesanan->layanan) == '' ? 'selected' : '' }}>- Pilih Layanan -</option>
                            <option value="dinein" {{ old('layanan', $pesanan->layanan) == 'dinein' ? 'selected' : '' }}>Dine-In</option>
                            <option value="takeaway" {{ old('layanan', $pesanan->layanan) == 'takeaway' ? 'selected' : '' }}>Takeaway</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label><b>Nama Pelanggan</b></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="pelanggan" disabled class="form-control" value="{{ old('pelanggan', $pesanan->pelanggan) }}">
                    </div>
                </div>
            </form>
            <div class="table-responsive table-hover mt-3">
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Qty</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesan as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/img-menu/' . $row->menu->foto) }}" width="100px" alt="Foto Menu"></td>
                            <td>{{ $row->menu->nama_menu }}</td>
                            <td>{{ $row->qty }}</td>
                            <td>{{ $row->catatan }}</td>
                            <td>
                                <label><input type="checkbox" id="centang"><span></span></label>                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-12 text-center">
                <a href="{{ route('backend.proses.index') }}">
                    <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
                </a>
                <a href="{{ route('detail-pesanan.selesai', [Request::segment(2)]) }}" class="btn btn-success"><i class="fas fa-check"></i> Selesai</a>
            </div>
        </div>
    </div>
</div>

@endsection