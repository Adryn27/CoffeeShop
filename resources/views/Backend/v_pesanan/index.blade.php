@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
    <div class="card mt-3">
      <div class="card-header">
        <h3><b>{{ $judul }}</b></h3>
      </div>
      <div class="card-body">
        <div class="col d-flex justify-content-end">
          <a href="{{ route('backend.pesanan.create') }}">
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
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pesan as $row )
                    <td>
                        <a href="{{ route('backend.pesanan.edit') }}">
                            <button class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Edit</button>
                        </a>

                        <form action="{{ route('backend.pesanan.destroy') }}" method="POST" style="display: inline-block">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="#"><i class="fas fa-trash"> Hapus</i></button>
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