@extends('backend.v_layout.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-5 col-sm-10"> <!-- Atur lebar card di berbagai layar -->
          <div class="card">
              <div class="card-header">
              <h3>{{ $judul }}</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12">
                  @if ($show->foto)
                      <img src="{{ asset('storage/img-user/' . $show->foto) }}" class="foto-preview" width="100%">
                  @else
                      <img src="{{ asset('storage/img-user/undraw_profile.png') }}" class="foto-preview" width="100%">
                  @endif

                  @error('foto')
                      <div class="invalid-feedback alert-danger">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
    
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <a href="{{ route('backend.user.index') }}">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                        </a>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection