@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
      <div class="card mt-3">
        <div class="card-header">
          <h3><b>{{ $judul }}</b></h3>
        </div>
        <div class="card-body">
          <div class="col d-flex justify-content-end">
            <a href="{{ route('backend.user.create') }}">
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
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No.HP</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($index as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          @if ($row->foto)
                            <img src="{{ asset('storage/img-user/' . $row->foto) }}" width="50px" height="60px" alt="Foto Pengguna">
                          @else
                            <img src="{{ asset('storage/img-user/undraw_profile.png') }}" width="50px" alt="Foto Pengguna">
                          @endif
                        </td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->hp }}</td>
                        <td>
                            @if ($row->role == 2)
                                <span class="badge bg-primary" style="color: white">Barista</span>
                            @elseif ($row->role == 1)
                                <span class="badge bg-warning" style="color: white">Kasir</span>    
                            @elseif ($row->role == 0)
                                <span class="badge bg-success" style="color: white">Admin</span>    
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('backend.user.edit', $row->id) }}">
                                <button class="btn btn-warning btn-sm">
                                  <i class="far fa-edit"></i> Edit</button>
                            </a>

                            <form action="{{ route('backend.user.destroy', $row->id) }}" method="POST" style="display: inline-block">
                                @method('delete')
                                @csrf

                                <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $row->nama }}"><i class="fas fa-trash"> Hapus</i></button>
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