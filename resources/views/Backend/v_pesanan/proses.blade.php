@extends('backend.v_layout.app')
@section('content')

<div class="col-12">
    <div class="card mt-3">
      <div class="card-header">
        <h3><b>{{ $judul }}</b></h3>
      </div>
      <div class="card-body">
        <div class="table-responsive table-hover mt-3">
          <table
            id="dataTable"
            class="table table-striped table-bordered"
          >
          <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Waktu Order</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pesan as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->pelanggan }}</td>
                <td>{{ $row->created_at }}</td>
                <td>
                  <a href="{{ route('backend.proses.show', $row->id) }}">
                    <button class="btn btn-primary btn-sm"><i class="far fa-eye"></i> Proses</button>
                </a>
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