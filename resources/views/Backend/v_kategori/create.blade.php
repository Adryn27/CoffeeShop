@extends('Backend.v_layout.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('backend.kategori.store') }}" method="POST">
              @csrf 

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                    class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Masukan Nama Kategori">
                    @error('nama_kategori')
                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>                        
                    @enderror
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('') }}"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>