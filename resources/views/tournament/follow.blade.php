@extends('layouts.main')

@section('title') Tournament Diikuti @endsection

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
                                <li class="breadcrumb-item active">Tournament Diikuti
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
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="{{ url('/tournament/detail/'.$d->slug) }}">{{ $d->nama }}</a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Anonymous</a></span>
                            </h6>
                            <p class="card-text item-description">
                                {{ strip_tags($d->deskripsi) }}
                            </p>
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
@endsection