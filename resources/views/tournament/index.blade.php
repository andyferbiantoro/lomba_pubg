@extends('layouts.main')

@section('title') Tournament @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css') }}">
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Tournament</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Semua Tournament
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached mt-1">
            <div class="content-body">
                <section id="ecommerce-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ecommerce-header-items">
                                <div class="result-toggler">
                                    <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                        <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                    </button>
                                    <!-- <div class="search-results">16285 hasil ditemukan</div> -->
                                    @auth
                                    @if(Auth::user()->role != 'peserta')
                                    <a href="{{ url('/tournament/add') }}" class="btn btn-primary">Posting Tournament</a>
                                    @endif
                                    @endauth
                                </div>
                                <div class="view-options d-flex">
                                    <div class="btn-group dropdown-sort">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="active-sorting">Semua</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">Semua</a>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn">
                                            <input type="radio" name="radio_options" id="radio_option1" checked />
                                            <i data-feather="grid" class="font-medium-3"></i>
                                        </label>
                                        <label class="btn btn-icon btn-outline-primary view-btn list-view-btn">
                                            <input type="radio" name="radio_options" id="radio_option2" />
                                            <i data-feather="list" class="font-medium-3"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- background Overlay when sidebar is shown  starts-->
                <div class="body-content-overlay"></div>
                <!-- background Overlay when sidebar is shown  ends-->

                <!-- <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control search-product" id="shop-search" placeholder="Cari Tournament" aria-label="Cari..." aria-describedby="tournament-search" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->

                <hr>
                <h3 style="color: white">Tournament Hari Ini</h3>
                <section id="ecommerce-products" class="grid-view">

                    @foreach($turnament_now as $t_now)
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="{{ url('/tournament/detail/'.$t_now->slug) }}">
                                <img class="img-fluid card-img-top" src="{{ url('storage/images/tournament/thumbnail/'.$t_now->thumbnail) }}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div>
                                    Tersedia <b class="text-warning">{{ $t_now->sisa_slot }}</b> dari <b>{{ $t_now->jumlah_slot }}</b> Slot
                                </div>
                                <div>
                                    <h6 class="item-price text-light">Rp {{ number_format($t_now->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="{{ url('/tournament/detail/'.$t_now->slug) }}">{{ $t_now->nama }} - <span class="text-info text-uppercase">{{ $t_now->type }}</span></a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Anonymous</a></span>
                            </h6>
                            <p class="card-text item-description">
                                {{ strip_tags($t_now->deskripsi) }}
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price text-light">Rp {{ number_format($t_now->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h4>
                                </div>
                            </div>
                            <a href="{{ url('tournament/detail/'.$t_now->slug) }}" class="btn btn-primary btn-cart">
                                <span>Detail</span>
                            </a>
                            <!-- <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a> -->
                        </div>
                    </div>
                    @endforeach
                    
                </section>

                <hr>
                <h3 style="color: white">Tournament Akan Datang</h3>
                <section id="ecommerce-products" class="grid-view">

                    @foreach($data as $d)
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="{{ url('/tournament/detail/'.$d->slug) }}">
                                <img class="img-fluid card-img-top" src="{{ url('storage/images/tournament/thumbnail/'.$d->thumbnail) }}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div>
                                    Tersedia <b class="text-warning">{{ $d->sisa_slot }}</b> dari <b>{{ $d->jumlah_slot }}</b> Slot
                                </div>

                                <div>
                                    <h6 class="item-price text-light">Rp {{ number_format($d->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h6>
                                </div><br>

                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="{{ url('/tournament/detail/'.$d->slug) }}">{{ $d->nama }} - <span class="text-info text-uppercase">{{ $d->type }}</span></a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Anonymous</a></span>
                            </h6>
                            <p class="card-text item-description">
                                {{ strip_tags($d->deskripsi) }}
                            </p>
                            <div>
                                <span class="text-warning">Terakhir Pendaftaran</span> : {{ tanggal_indonesia($d->tgl_valid) }}
                            </div>
                            <div>
                                <span class="text-info">Tanggal Tournament</span> : {{ tanggal_indonesia($d->tgl_tournament) }}
                            </div>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price text-light">Rp {{ number_format($d->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h4>
                                </div>
                            </div>
                            <a href="{{ url('tournament/detail/'.$d->slug) }}" class="btn btn-primary btn-cart">
                                <span>Detail</span>
                            </a>
                            <!-- <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a> -->
                        </div>
                    </div>
                    @endforeach
                    
                </section>

               <!--  @auth
                @if(Auth::user()->role = 'admin') -->
                <hr>
                <h3 style="color: white">Tournament Telah Selesai</h3>
                <section id="ecommerce-products" class="grid-view">

                    @foreach($turnament_done as $done)
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="{{ url('/tournament/detail/'.$done->slug) }}">
                                <img class="img-fluid card-img-top" src="{{ url('storage/images/tournament/thumbnail/'.$done->thumbnail) }}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div>
                                    Tersedia <b class="text-warning">{{ $done->sisa_slot }}</b> dari <b>{{ $done->jumlah_slot }}</b> Slot
                                </div>

                                <div>
                                    <h6 class="item-price text-light">Rp {{ number_format($done->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h6>
                                </div><br>

                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="{{ url('/tournament/detail/'.$done->slug) }}">{{ $done->nama }} - <span class="text-info text-uppercase">{{ $done->type }}</span></a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Anonymous</a></span>
                            </h6>
                            <p class="card-text item-description">
                                {{ strip_tags($done->deskripsi) }}
                            </p>
                            <div>
                                <span class="text-warning">Terakhir Pendaftaran</span> : {{ tanggal_indonesia($done->tgl_valid) }}
                            </div>
                            <div>
                                <span class="text-info">Tanggal Tournament</span> : {{ tanggal_indonesia($done->tgl_tournament) }}
                            </div>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price text-light">Rp {{ number_format($done->biaya_pendaftaran, 0, '.', '.') }} <span class="text-secondary">/ team</span></h4>
                                </div>
                            </div>
                            <a href="{{ url('tournament/detail/'.$done->slug) }}" class="btn btn-primary btn-cart">
                                <span>Detail</span>
                            </a>
                            <!-- <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a> -->
                        </div>
                    </div>
                    @endforeach
                    
                </section>
               <!--  @endif
                @endauth -->

                <!-- Pagination Starts -->
                <section id="ecommerce-pagination">
                    <div class="row">
                        <div class="col-sm-12">
                            {{ $data->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </section>
                <!-- Pagination Ends -->

            </div>
        </div>

    </div>
</div>
<!-- END: Content-->
@endsection

@section('js')
<script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce.js') }}"></script>

@if($message = Session::get('success'))
<script>
    Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2200,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    </script>
    @endif

    @if($message = Session::get('error'))
    <script>
        Swal.fire({
            // position: 'top-end',
            icon: 'error',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2200,
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
    </script>
    @endif
    @endsection