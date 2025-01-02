@extends('backend.v_layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-10"> <!-- Atur lebar card di berbagai layar -->
            <div class="card">
                <div class="card-header">
                    <h3><b>{{ $judul }}</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.kategori.update', $edit->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                          <label>Nama Kategori</label>
                          <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $edit->nama_kategori) }}"
                            class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Masukkan Nama Kategori">
                          @error('nama_kategori')
                            <span class="invalid-feedback alert-danger" role="alert">
                              {{ $message }}
                            </span>
                          @enderror
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbaharui</button>
                            <a href="{{ route('backend.kategori.index') }}">
                              <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
                            </a>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection