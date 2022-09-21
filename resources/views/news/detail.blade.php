@extends('layouts.main')

@section('title') Detail Berita @endsection

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
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Detail Berita</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('news') }}">Berita</a>
                                </li>
                                <li class="breadcrumb-item active">Detail
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @auth
                @if(Auth::user()->role == 'admin')
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('/news/edit/'.$data->slug) }}">
                                    <i class="mr-1" data-feather="edit-2"></i>
                                    <span class="align-middle">Edit</span>
                                </a>
                                <form id="form-delete" action="{{ url('/news/detail/delete/'.$data->id_berita) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a class="dropdown-item" id="delete" href="#">
                                        <i class="mr-1" data-feather="trash-2"></i>
                                        <span class="align-middle">Hapus</span>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endauth
        </div>
        <div class="content-detached content-left">
            <div class="content-body">
                <!-- Blog Detail -->
                <div class="blog-detail-wrapper">
                    <div class="row">
                        <!-- Blog -->
                        <div class="col-12">
                            <div class="card">
                                <img src="{{ url('storage/images/berita/thumbnail/'.$data->thumbnail) }}" class="img-fluid card-img-top" alt="Blog Detail Pic" />
                                <div class="card-body">
                                    <h4 class="card-title">{{ $data->judul }}</h4>
                                    <div class="media">
                                        <div class="avatar mr-50">
                                            @if($data->pembuat->foto == '' || $data->pembuat->foto == null)
                                            <img src="{{ asset('images/default.jpg') }}" alt="Avatar" width="24" height="24" />
                                            @else
                                            <img src="{{ url('storage/images/profile/'.$data->pembuat->foto) }}" alt="Avatar" width="24" height="24" />
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <small class="text-muted mr-25">by</small>
                                            <small><a href="javascript:void(0);" class="text-body text-capitalize">{{ $data->pembuat->nama }}</a></small>
                                            <span class="text-muted ml-50 mr-25">|</span>
                                            <small class="text-muted">{{ tanggal_indonesia(date("Y-m-d", strtotime($data->created_at))) }}</small>
                                        </div>
                                    </div>
                                    <div class="my-1 py-25">
                                        @foreach(explode(',', $data->tag) as $info)
                                            <a href="javascript:void(0);">
                                            @switch($info)
                                                @case('Gaming')
                                                    <div class="badge badge-pill badge-light-danger mr-50">{{ $info }}</div>
                                                    @break
                                                @case('Video')
                                                    <div class="badge badge-pill badge-light-warning mr-50">{{ $info }}</div>
                                                    @break
                                                @default
                                                    <div class="badge badge-pill badge-light-info mr-50">{{ $info }}</div>
                                                    @break
                                            @endswitch
                                            </a>
                                        @endforeach
                                    </div>
                                    <p class="card-text mb-2">
                                        {!! $data->isi !!}
                                    </p>
                                    
                                    <!-- <div class="media">
                                        <div class="avatar mr-2">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" width="60" height="60" alt="Avatar" />
                                        </div>
                                        <div class="media-body">
                                            <h6 class="font-weight-bolder">Willie Clark</h6>
                                            <p class="card-text mb-0">
                                                Based in London, Uncode is a blog by Willie Clark. His posts explore modern design trends through photos
                                                and quotes by influential creatives and web designer around the world.
                                            </p>
                                        </div>
                                    </div> -->
                                    <hr class="my-2" />
                                    <div class="d-flex align-items-center justify-content-between">
                                        <!-- <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center mr-1">
                                                <a href="javascript:void(0);" class="mr-50">
                                                    <i data-feather="message-square" class="font-medium-5 text-body align-middle"></i>
                                                </a>
                                                <a href="javascript:void(0);">
                                                    <div class="text-body align-middle">19.1K</div>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="mr-50">
                                                    <i data-feather="bookmark" class="font-medium-5 text-body align-middle"></i>
                                                </a>
                                                <a href="javascript:void(0);">
                                                    <div class="text-body align-middle">139</div>
                                                </a>
                                            </div>
                                        </div> -->
                                        <div class="dropdown blog-detail-share">
                                            <i data-feather="share-2" class="font-medium-5 text-body cursor-pointer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                                                    <i data-feather="facebook" class="font-medium-3"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                                                    <i data-feather="twitter" class="font-medium-3"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                                                    <i data-feather="linkedin" class="font-medium-3"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Blog -->

                        <!-- Blog Comment -->
                        @livewire('comments', ['id_berita' => $data->id_berita])
                        <!--/ Blog Comment -->

                    </div>
                </div>
                <!--/ Blog Detail -->

            </div>
        </div>
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
                <div class="blog-sidebar my-2 my-lg-0">
                    <!-- Search bar -->
                    <form action="{{ url('news/search') }}" method="get" id="form">
                        @csrf
                        <div class="blog-search">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="Cari..." name="search" required />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer" onclick="$('#form').submit();">
                                        <i data-feather="search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ Search bar -->

                    <!-- Recent Posts -->
                    <div class="blog-recent-posts mt-3">
                        <h6 class="section-label">Berita Terakhir</h6>
                        @foreach($new as $n)
                        <div class="mt-75">
                            <div class="media mb-2">
                                <a href="{{ url('/news/detail/'.$n->slug) }}" class="mr-2">
                                    <img class="rounded" src="{{ url('storage/images/berita/thumbnail/'.$n->thumbnail) }}" width="100" height="70" alt="Thumbnail" />
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
@livewireScripts
<script>
    $('#delete').on('click', function(e) {
        e.preventDefault();
        let form = $('#form-delete');
        Swal.fire({
            title: '<strong>Hapus Berita?</strong>',
            icon: 'info',
            html:
            'Jika dihapus, data tidak dapat dikembalikan!',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Hapus',
            // confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: feather.icons['x'].toSvg({ class: 'font-medium-1' }),
            // cancelButtonAriaLabel: 'Thumbs down',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false
        }).then(function(isConfirm) {
            if(isConfirm.value == true) {
                form.submit();
            }
        });
    });
</script>
@endsection