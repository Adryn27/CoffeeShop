@extends("Backend.v_layout.app")
@section('content')

<div class="col-12 mt-2">
  <div class="card">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
          @foreach ($menu as $row)
              <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}" 
                  class="{{ $loop->first ? 'active' : '' }}">
              </li>
          @endforeach
      </ol>
    
      <div class="carousel-inner rounded">
          @foreach ($menu as $row)
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                  <img src="{{ asset('storage/img-menu/' . $row->foto) }}" class="img-fluid w-100" style="height:300px; object-fit:cover">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>{{ $row->nama_menu }}</h5>
                      <p>{{ $row->deskripsi }}</p>
                  </div>
              </div>
          @endforeach
      </div>
    
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="card-body text-center">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Selamat Datang {{ Auth::user()->nama }}</h4>
        Anda login dengan hak akses 
        <b>
          @if (Auth::user()->role == 2)
              Bartender
          @elseif (Auth::user()->role == 1)
              Kasir
          @elseif (Auth::user()->role == 0)
              Admin
          @endif
      </b>
      </div>
      <h5 class="card-title"><b>KOPIKAMPUS</b></h5>
      <p class="card-text">Ini adalah platform manajemen kedai kopi KopiKampus yang dirancang untuk memberikan kemudahan dalam pengelolaan operasional harian. Dengan sistem backend yang efisien, admin dapat mengatur berbagai aspek bisnis secara terpusat, mulai dari manajemen menu, pengelolaan pesanan hingga pemantauan transaksi secara real-time.</p>
      <hr>
      <p>KopiKampus, Teman yang Tepat di Setiap Langkah</p>
    </div>
    </div>
  </div>
@endsection