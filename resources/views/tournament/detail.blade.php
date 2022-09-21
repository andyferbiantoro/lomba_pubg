@extends('layouts.main')

@section('title') Detail Turnamen @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce-details.css') }}">
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Detail Tournament</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('tournament') }}">Tournament</a>
                                </li>
                                <li class="breadcrumb-item active">Detail
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @auth
                @if(Auth::user()->id_user == $data->id_penyelenggara)
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('/tournament/edit/'.$data->slug) }}">
                                    <i class="mr-1" data-feather="edit-2"></i>
                                    <span class="align-middle">Edit</span>
                                </a>
                                <a class="dropdown-item" href="{{ url('/tournament/detail/'.$data->slug.'/add-winner') }}">
                                    <i class="mr-1" data-feather="plus"></i>
                                    <span class="align-middle">Pemenang</span>
                                </a>
                                <form id="form-delete" action="{{ url('/tournament/detail/delete/'.$data->id_tournament) }}" method="post">
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
        <div class="content-body">
            <!-- app e-commerce details start -->
            <section class="app-ecommerce-details">
                <div class="card">
                    <!-- Product Details starts -->
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/images/tournament/thumbnail/'.$data->thumbnail) }}" class="img-fluid product-img" alt="product image" />
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <h4>{{ $data->nama }} - <span class="text-info text-uppercase">{{ $data->type }}</span></h4>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">{{ $data->penyelenggara->nama }}</a></span>
                                <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                    <h4 class="item-price mr-1">Rp {{ number_format($data->biaya_pendaftaran, 0, '.', '.') }}</h4>

                                </div>
                                <p class="card-text">{{ $data->jumlah_slot }} Slot - <span class="text-success">{{ $data->sisa_slot }} Tersedia</span></p>
                                <p class="card-text">
                                    <i data-feather="map-pin" class="mr-50"></i> {{ $data->lokasi }}
                                </p>
                                <p class="card-text">
                                    {!! $data->deskripsi !!}
                                </p>

                                <hr />
                                <p class="card-text">
                                    <div>
                                        <span class="text-warning">Terakhir Pendaftaran</span> : {{ tanggal_indonesia($data->tgl_valid) }}
                                    </div>
                                    <div>
                                        <span class="text-info">Tanggal Tournament</span> : {{ tanggal_indonesia($data->tgl_tournament) }}
                                    </div>
                                </p>
                                <div class="d-flex flex-column flex-sm-row pt-1">
                                    @switch($status)
                                        @case(0)
                                            <a href="{{ url('login') }}" class="btn btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
                                                <i data-feather="corner-down-right" class="mr-50"></i>
                                                <span class="add-to-cart">Silahkan Login</span>
                                            </a>
                                            @break
                                        @case(1)
                                            <div class="btn btn-info mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                <i data-feather="corner-down-right" class="mr-50"></i>
                                                <span class="add-to-cart">Sudah Daftar</span>
                                            </div>
                                            @break
                                        @case(2)
                                            @if($data->id_penyelenggara != Auth::user()->id_user && Auth::user()->role != 'admin')
                                                <button type="button" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0" data-toggle="modal" data-target="#formDaftar">
                                                    <i data-feather="corner-down-right" class="mr-50"></i>
                                                    <span class="add-to-cart">Daftar</span>
                                                </button>

                                               
                                            @elseif(Auth::user()->role != 'admin')
                                                <a href="#" class="btn btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
                                                    <i data-feather="corner-down-right" class="mr-50"></i>
                                                    <span class="add-to-cart">Anda Penyelenggara Tournament</span>
                                                </a>
                                            @elseif(Auth::user()->role == 'admin')

                                             <a href="{{ url('/pemenang/detail/'.$data->slug) }}" class="btn btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
                                                    <i data-feather="gift" class="mr-50"></i>
                                                    <span class="add-to-cart">Lihat Pemenang</span>
                                                </a>
                                            @endif
                                            @break
                                        @case(3)
                                            @if($data->id_penyelenggara != Auth::user()->id_user)
                                                <button type="button" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0" data-toggle="modal" data-target="#modalverifikasi">
                                                    <i data-feather="corner-down-right" class="mr-50"></i>
                                                    <span class="add-to-cart">Daftar</span>
                                                </button>
                                            @else
                                                <a href="#" class="btn btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
                                                    <i data-feather="corner-down-right" class="mr-50"></i>
                                                    <span class="add-to-cart">Anda Penyelenggara Tournament</span>
                                                </a>
                                            @endif
                                       <!--  @case(4)
                                            @if(Auth::user()->role == 'admin')
                                             <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ url('/pemenang/detail/'.$data->slug) }}" class="font-weight-bold">Selengkapnya</a>
                                                </div>
                                            @else
                                            <a href="#" class="btn btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
                                                <i data-feather="corner-down-right" class="mr-50"></i>
                                                <span class="add-to-cart">Anda Penyelenggara Tournament</span>
                                            </a>
                                            @endif -->
                                            @break
                                    @endswitch

                                    @auth
                                    @if(Auth::user()->role == 'penyelenggara')
                                    <a href="{{ url('pemenang/add/'.$data->slug) }}"><button type="button" class="btn btn-success mr-0 mr-sm-1 mb-1 mb-sm-0">
                                        <i data-feather="gift" class="mr-50" style="color: white"></i>
                                        <span class="add-to-cart" style="color: white">Pemenang</span></a>
                                    </button>
                                    @endif
                                    @endauth

                                    @if($data->file != null && $data != '')
                                    <a href="{{ url('storage/images/tournament/file/'.$data->file) }}" target="_blank" class="btn btn-secondary mr-0 mr-sm-1 mb-1 mb-sm-0">
                                        <i data-feather="download" class="mr-50"></i>
                                        <span class="add-to-cart">Download Poster/File</span>
                                    </a>
                                    @endif
                                    <div class="btn-group dropdown-icon-wrapper btn-share">
                                        <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="share-2"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i data-feather="facebook"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i data-feather="twitter"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i data-feather="instagram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                 <p class="card-text">
                                    @auth
                                    @if(Auth::user()->role == 'admin')
                                    <form action="{{ url('tournament/update_link/'.$data->slug) }}" class="mt-2" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="link_room">Link Room</label>
                                                    <input type="text" id="link_room" class="form-control" name="link_room" value="{{ $data->link_room }}" placeholder="link room tournament"/>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-1">Upload Link</button>
                                    </form>
                                    @elseif(Auth::user()->role == 'peserta')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="link_room">Link Room</label>
                                                <input type="text" id="link_room" class="form-control" name="link_room" value="{{ $data->link_room }}" placeholder="link room tournament" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endauth
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details ends -->

                    <!-- peserta tournament -->
                    @auth
                    @if(Auth::user()->role == 'penyelenggara' && $data->id_penyelenggara == Auth::user()->id_user)
                        <hr>
                        <h3 class="ml-2 mb-2">Daftar Peserta Tournament</h3>
                        <div class="content-body">
                            <section class="app-user-list">
                                <div class="card">
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="user-list-table table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Logo</th>
                                                    <th>Nama Team</th>
                                                    <th>Anggota 1 (Ketua)</th>
                                                    <th>Anggota 2</th>
                                                    <th>Anggota 3</th>
                                                    <th>Anggota 4</th>
                                                    <th>Anggota 5 (Cadangan)</th>
                                                    <th>Tipe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data->peserta_tournament as $pt)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('storage/images/transaksi/logo/'.$pt->logo) }}" target="_blank" rel="noopener noreferrer">
                                                                <img src="{{ url('storage/images/transaksi/logo/'.$pt->logo) }}" alt="Logo" height="48" width="48">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{ $pt->team }}
                                                        </td>
                                                        <td>
                                                            {{ $pt->anggota_1 }}
                                                        </td>
                                                        <td>
                                                            @if($pt->anggota_2 == '' || $pt->anggota_2 == null)
                                                                -
                                                            @else
                                                                {{ $pt->anggota_2 }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($pt->anggota_3 == '' || $pt->anggota_3 == null)
                                                                -
                                                            @else
                                                                {{ $pt->anggota_3 }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($pt->anggota_4 == '' || $pt->anggota_4 == null)
                                                                -
                                                            @else
                                                                {{ $pt->anggota_4 }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($pt->anggota_5 == '' || $pt->anggota_5 == null)
                                                                -
                                                            @else
                                                                {{ $pt->anggota_5 }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="text-uppercase">{{ $pt->type }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </section>
                        </div>
                    @endif
                    @endauth

                    <!-- Item features starts -->
                    <div class="item-features">
                        <div class="row text-center">
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <i data-feather="award"></i>
                                    <h4 class="mt-2 mb-1">100% Asli</h4>
                                    <p class="card-text">Tournament yang diposting dijamin asli.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <i data-feather="clock"></i>
                                    <h4 class="mt-2 mb-1">Transaksi Mudah</h4>
                                    <p class="card-text">Transaksi sangat mudah.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <i data-feather="shield"></i>
                                    <h4 class="mt-2 mb-1">Garansi</h4>
                                    <p class="card-text">Terdapat garansi jika terjadi kesalahan teknis atau penipuan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item features ends -->

                </div>
            </section>
            <!-- app e-commerce details end -->

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formDaftar" tabindex="-1" role="dialog" aria-labelledby="formDaftarTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formDaftarTitle">Daftar Tournament</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInputFile">Nama Team</label>
                                <input type="text" class="form-control" id="basicInput" name="team" placeholder="Masukkan Nama Team" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="customFile">Logo Team</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="logo" required/>
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nama Anggota 1 (Ketua)</label>
                                <input type="text" class="form-control" id="basicInput" name="anggota_1" placeholder="Masukkan nama anggota" required/>
                            </div>
                        </div>
                    </div>
                    @if($data->type == 'duo' || $data->type == 'squad')
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nama Anggota 2</label>
                                <input type="text" class="form-control" id="basicInput" name="anggota_2" placeholder="Masukkan nama anggota" required/>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($data->type == 'squad')
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nama Anggota 3</label>
                                <input type="text" class="form-control" id="basicInput" name="anggota_3" placeholder="Masukkan nama anggota"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nama Anggota 4</label>
                                <input type="text" class="form-control" id="basicInput" name="anggota_4" placeholder="Masukkan nama anggota"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nama Anggota 5 (Cadangan)</label>
                                <input type="text" class="form-control" id="basicInput" name="anggota_5" placeholder="Masukkan nama anggota"/>
                            </div>
                        </div>
                    </div>

                    @endif
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nomor Rekening</label>
                                <input type="text" class="form-control" id="basicInput" name="no_rekening" placeholder="Masukkan Nomor Rekening"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Type</label>
                                <h5 class="text-uppercase">{{ $data->type }}</h5>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $data->penyelenggara->nama }}" name="penyelenggara">
                    <input type="hidden" value="{{ $data->type }}" name="type">
                </div>
             <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalverifikasi" tabindex="-1" role="dialog" aria-labelledby="modalverifikasiTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalverifikasiTitle">Verifikasi email anda!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Verifikasi email anda terlebih dahulu !
             <div class="modal-footer">
                    <a href="{{ url('email/verify') }}" class="btn btn-primary">Verifikasi</a>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#winnermodal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="winnermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- END: Content-->
@endsection

@section('js')
<script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce-details.js') }}"></script>

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

<script>
    $('#delete').on('click', function(e) {
        e.preventDefault();
        let form = $('#form-delete');
        Swal.fire({
            title: '<strong>Hapus Tournament?</strong>',
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