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
                    <form action="{{ route('backend.menu.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    {{-- view image --}}
                                    <img src="{{ asset('storage/img-menu/' . $edit->foto) }}" class="foto-preview" width="100%">
                                    <p></p>
                                    {{-- file foto --}}
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
                                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                        <option value="" selected> - Pilih Katagori - </option>
                                        @foreach ($kategori as $row)
                                          @if (old('kategori_id', $edit->kategori_id) == $row->id)
                                            <option value="{{ $row->id }}" selected> {{ $row->nama_kategori }} </option>
                                          @else
                                            <option value="{{ $row->id }}"> {{ $row->nama_kategori }} </option>
                                          @endif
                                        @endforeach
                                      </select>
                                      @error('kategori_id')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                      @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu" value="{{ old('nama_menu', $edit->nama_menu) }}" class="form-control @error('nama_menu') is-invalid @enderror" placeholder="Masukkan Nama Menu">
                                    @error('nama_menu')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
                                        {{ old('deskripsi', $edit->deskripsi) }}
                                    </textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="harga" value="{{ old('harga', $edit->harga) }}" class="form-control @error('harga') is-invalid @enderror" placeholder="Masukkan Harga" onkeypress="return hanyaAngka(event)">
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
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a href="{{ route('backend.menu.index') }}">
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