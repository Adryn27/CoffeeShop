@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
    <div class="card mt-3">
      <div class="card-header">
        <h3><b>{{ $judul }}</b></h3>
      </div>
      <div class="card-body">
        <div class="col d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakModal">
                <i class="fas fa-file-pdf"> Cetak</i>
            </button>
          </div>
        <div class="table-responsive table-hover mt-3">
          <table
            id="dataTable"
            class="table table-striped table-bordered"
          >
          <thead>
            <tr>
                <th>No</th>
                <th>No Pesanan</th>
                <th>Pelanggan</th>
                <th>Waktu Order</th>
                <th>Detail Pesanan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($pesan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->pelanggan }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <ul>
                                @foreach ($item->detailPesanan as $detail)
                                    <li>
                                        <img src="{{ asset('storage/img-menu/' . $detail->menu->foto) }}" width="50px" alt="Foto Menu">
                                        <span>{{ $detail->menu->nama_menu }} - {{ $detail->qty }}</span>
                                    </li>
                                    <p></p>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('laporan.cetakpesan') }}" method="POST" target="_blank">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Cetak Laporan Detail Pesanan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" onkeypress="return hanyaAngka(event)" name="tanggal_awal" value="{{ old('tanggal_awal') }}" class="form-control @error('tanggal_awal') is-invalid @enderror" placeholder="Masukkan Tanggal Awal">
                        @error('tanggal_awal')
                            <div class="invalid-feedback alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" onkeypress="return hanyaAngka(event)" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" class="form-control @error('tanggal_akhir') is-invalid @enderror" placeholder="Masukkan Tanggal Akhir">
                        @error('tanggal_akhir')
                            <div class="invalid-feedback alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection