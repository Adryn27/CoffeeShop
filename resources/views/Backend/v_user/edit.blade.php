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
                    <form action="{{ route('backend.user.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    @if ($edit->foto)
                                        <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview" width="100%">
                                    @else
                                        <img src="{{ asset('storage/img-user/undraw_profile.png') }}" class="foto-preview" width="100%">
                                    @endif
                                    
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
                                    <label>Role</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>- Pilih Role -</option>
                                        <option value="0" {{ old('role', $edit->role) == '0' ? 'selected' : '' }}>Admin</option>
                                        <option value="1" {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>Kasir</option>
                                        <option value="2" {{ old('role', $edit->role) == '2' ? 'selected' : '' }}>Barista</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama', $edit->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                    @error('nama')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                    @error('email')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label>HP</label>
                                    <input type="text" name="hp" value="{{ old('hp', $edit->hp) }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP" onkeypress="return hanyaAngka(event)">
                                    @error('hp')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
            
                            </div>
                        </div>
            
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbaharui</button>
                                <a href="{{ route('backend.user.index') }}">
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