@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
    <div class="card mt-3">
      <div class="card-header">
        <h3><b>{{ $judul }}</b></h3>
      </div>
      <div class="card-body">
        <div class="col d-flex justify-content-end">
          <a href="{{ route('backend.menu.create') }}">
            <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
          </a>
        </div>
        <div class="table-responsive table-hover mt-3">
          <table
            id="dataTable"
            class="table table-striped table-bordered"
          >
          <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menu as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/img-menu/' . $row->foto) }}" width="50px" alt="Foto Menu"></td>
                    <td>{{ $row->kategori->nama_kategori }}</td>
                    <td>{{ $row->nama_menu }}</td>
                    <td>Rp {{ number_format($row->harga), 0, ',', '.' }}</td>
                    <td>
                      @if($row->status == 'sedia')
                        <span class="badge bg-success" style="color: white">Tersedia</span>
                      @else
                        <span class="badge bg-warning" style="color: white">Tidak Tersedia</span>
                      @endif
                    </td>
                    <td>
                        <a href="{{ route('backend.menu.edit', $row->id) }}">
                            <button class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Edit</button>
                        </a>

                        <form action="{{ route('backend.menu.destroy', $row->id) }}" method="POST" style="display: inline-block">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $row->nama_menu }}"><i class="fas fa-trash"> Hapus</i></button>
                        </form>
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
@endsection