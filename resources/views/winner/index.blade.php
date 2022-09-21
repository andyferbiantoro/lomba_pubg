@extends('layouts.main')

@section('title') Pemenang @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-blog.css') }}">
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-10 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Pemenang</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Pemenang
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @auth
               <!--  <div class="col-md-2 text-right">
                    <a href="{{ url('pemenang/add') }}" class="btn btn-primary">Tambah</a>
                </div> -->
            @endauth
        </div>
        <div class="content-detached content-left">
            <div class="content-body">
                <!-- Blog List -->
                <div class="blog-list-wrapper">
                    <!-- Blog List Items -->
                    <div class="row">
                        @foreach($data as $d)
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <a href="{{ url('/pemenang/detail/'.$d->slug) }}">
                                    <img class="card-img-top img-fluid" src="{{ url('/storage/images/pemenang/thumbnail/'.$d->thumbnail) }}" alt="Thumbnail" />
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ url('/pemenang/detail/'.$d->slug) }}" class="blog-title-truncate text-body-heading">{{ $d->judul }}</a>
                                    </h4>
                                    <div class="media">
                                        <div class="avatar mr-50">
                                            @if($d->foto == '' || $d->foto == null)
                                            <img src="{{ asset('images/default.jpg') }}" alt="Avatar" width="24" height="24" />
                                            @else
                                            <img src="{{ url('storage/images/profile/'.$d->foto) }}" alt="Avatar" width="24" height="24" />
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <small class="text-muted mr-25">by</small>
                                            <small><a href="javascript:void(0);" class="text-body text-capitalize">{{ $d->nama }}</a></small>
                                            <span class="text-muted ml-50 mr-25">|</span>
                                            <small class="text-muted">{{ tanggal_indonesia(date("Y-m-d", strtotime($d->created_at))) }}</small>
                                        </div>
                                    </div>
                                    <div class="my-1 py-25">
                                        <a href="javascript:void(0);">
                                            <div class="badge badge-pill badge-light-info mr-50">Pemenang</div>
                                        </a>
                                        @if($d->role == 'peserta')
                                            <div class="badge badge-pill badge-light-success mr-50">Peserta Klaim Pemenang</div>
                                        @endif
                                    </div>
                                    <p class="card-text blog-content-truncate">
                                        {{ strip_tags($d->isi) }}
                                    </p>
                                    <hr />
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ url('/pemenang/detail/'.$d->slug) }}" class="font-weight-bold">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!--/ Blog List Items -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-12">
                            {{ $data->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                    <!--/ Pagination -->
                </div>
                <!--/ Blog List -->

            </div>
        </div>
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
                <div class="blog-sidebar my-2 my-lg-0">
                    <!-- Search bar -->
                    <div class="blog-search">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" placeholder="Cari..." />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer">
                                    <i data-feather="search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--/ Search bar -->

                    <!-- Recent Posts -->
                    <div class="blog-recent-posts mt-3">
                        <h6 class="section-label">Info Terakhir</h6>
                        @foreach($new as $n)
                        <div class="mt-75">
                            <div class="media mb-2">
                                <a href="{{ url('/news/detail/'.$n->slug) }}" class="mr-2">
                                    <img class="rounded" src="{{ url('storage/images/pemenang/thumbnail/'.$n->thumbnail) }}" width="100" height="70" alt="Thumbnail" />
                                </a>
                                <div class="media-body">
                                    <h6 class="blog-recent-post-title">
                                        <a href="{{ url('/news/detail/'.$n->slug) }}" class="text-body-heading">{{ $n->judul }}</a>
                                    </h6>
                                    <div class="text-muted mb-0">{{ tanggal_indonesia(date("Y-m-d", strtotime($n->created_at))) }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/ Recent Posts -->

                </div>

            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('js')
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