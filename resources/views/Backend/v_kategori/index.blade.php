@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
      <div class="card mt-3">
        <div class="card-header">
          <h3>{{ $judul }}</h3>
        </div>
        <div class="card-body">
          <div class="col d-flex justify-content-end">
            <a href="{{ route('backend.kategori.create') }}">
              <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
            </a>
          </div>
          <div class="table-responsive table-hover mt-3">
            <table
              id="dataTable"
              class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kategori as $row)
                  <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $row->nama_kategori }} </td>
                    <td>
                      <a href="{{ route('backend.kategori.edit', $row->id) }}">
                        <button type="button" class="btn btn-warning btn-sm"><i
                            class="far fa-edit"></i> Ubah</button>
                      </a>
                      <form method="POST" action="{{ route('backend.kategori.destroy', $row->id) }}"
                        style="display: inline-block;">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm show_confirm"
                          data-konf-delete="{{ $row->nama_kategori }}">
                          <i class="fas fa-trash"></i> Hapus</button>
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
@endsection