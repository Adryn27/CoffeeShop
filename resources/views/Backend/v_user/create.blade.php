<form action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="modal fade text-left" id="createUser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ __('Tambah Pengguna') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                      <label>Role</label>
                      <select name="role" class="form-control @error('role') is-invalid @enderror">
                          <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Pilih Role -</option>
                          <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option>
                          <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Kasir</option>
                          <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Bartender</option>
                      </select>
                      @error('role')
                          <div class="invalid-feedback alert-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                      <label>Nama</label>
                      <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                      @error('nama')
                          <div class="invalid-feedback alert-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                      @error('email')
                          <div class="invalid-feedback alert-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                      <label>HP</label>
                      <input type="text" name="hp" value="{{ old('hp') }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP" onkeypress="return hanyaAngka(event)">
                      @error('hp')
                          <div class="invalid-feedback alert-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                      @error('password')
                          <div class="invalid-feedback alert-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                      <label>Konfirmasi Password</label>
                      <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan Konfirmasi Password">
                      @error('password_confirmation')
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
                  <a href="{{ route('backend.user.index') }}">
                      <button type="button" class="btn btn-secondary">Kembali</button>
                  </a>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
</form>
