@extends('backend.v_layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-10"> <!-- Atur lebar card di berbagai layar -->
            <div class="card">
                <div class="card-header">
                    <h3>{{ $judul }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <img class="foto-preview">
                                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
            
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                        <option value="" {{ old('kategori_id') == '' ? 'selected' : '' }}>- Pilih Kategori -</option>
                                        @foreach ( $kategori as $k ) 
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu" value="{{ old('nama_menu') }}" class="form-control @error('nama_menu') is-invalid @enderror" placeholder="Masukkan Nama Produk">
                                    @error('nama_menu')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="ckeditor"></textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="harga" value="{{ old('harga') }}" class="form-control @error('harga') is-invalid @enderror" placeholder="Masukkan Harga" onkeypress="return hanyaAngka(event)">
                                    @error('harga')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
            
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('backend.menu.index') }}">
                                    <button type="button" class="btn btn-secondary">Kembali</button>
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