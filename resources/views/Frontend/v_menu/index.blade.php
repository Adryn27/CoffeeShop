@extends('Frontend.v_layout.apps')
@section('content')

<style>
    .grayscale {
        filter: grayscale(100%);
    }
</style>

<div class="col-12">
    <div class="px-4">
        <div class="card justify-content-center">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($content as $row)
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" 
                            class="{{ $loop->first ? 'active' : '' }}" 
                            aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->index + 1 }}">
                        </button>
                    @endforeach
                </div>
    
                <!-- Slides -->
                <div class="carousel-inner rounded">
                    @foreach ($content as $row)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img 
                                src="{{ asset('storage/img-menu/' . $row->foto) }}" 
                                class="img-fluid w-100" 
                                style="height:300px; object-fit:cover"
                            >
                            <div class="carousel-caption d-block">
                                <h5>{{ $row->nama_menu }}</h5>
                                <p>{{ $row->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container mt-4">
    @if(request('search'))
        <h5 class="mb-3">Hasil Pencarian: "{{ request('search') }}"</h5>
    @endif
    @foreach ($kategori as $kategori)
        <!-- Nama Kategori -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="text-success">{{ $kategori->nama_kategori }}</h4>
            </div>
        </div>

        <!-- Card Menu -->
        <div class="row">
            @foreach ($menu->where('kategori_id', $kategori->id) as $row)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4"> 
                    <div class="card shadow-sm" style="width: 100%;"> 
                        <div class="card-body">
                            <img src="{{ asset('storage/img-menu/' . $row->foto) }}" 
                                 class="card-img-top {{ $row->status == 'tidak' ? 'grayscale' : '' }}" 
                                 style="height: 150px; object-fit: cover;">
                            <hr>
                            <div class="text-center">
                                <h6 class="card-title">{{ $row->nama_menu }}</h6>
                                <p class="card-text">Rp {{ number_format($row->harga, 0, ',', '.') }}</p>
                                
                                <button type="button" class="btn btn-sm btn-success" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#infoModal{{ $row->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@foreach ($content as $row)
<div class="modal fade" id="infoModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Menu: {{ $row->nama_menu }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/img-menu/' . $row->foto) }}" alt="{{ $row->nama_menu }}" class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                </div>
                <div class="text-start">
                    <div class="row mb-2">
                        <div class="col-3"><strong>Nama Menu</strong></div>
                        <div class="col-9">: {{ $row->nama_menu }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"><strong>Harga</strong></div>
                        <div class="col-9">: Rp {{ number_format($row->harga, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"><strong>Status</strong></div>
                        <div class="col-9">
                            @if($row->status == 'sedia')
                                : <span class="badge bg-success">Tersedia</span>
                            @else
                                : <span class="badge bg-danger">Tidak Tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"><strong>Deskripsi</strong></div>
                        <div class="col-9">: {{ $row->deskripsi }}</div>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection