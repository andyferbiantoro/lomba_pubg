@extends('layouts.main')

@section('title') User Request Penyelenggara @endsection

@section('css')
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
                        <h2 class="content-header-title float-left mb-0">Request</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Request Penyelenggara
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section class="app-user-list">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>User</th>
                                    <th>No.HP</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </section>
        </div>

        <hr>
        <h3>Riwayat Permintaan</h3><br>

        <div class="content-body">
            <section class="app-user-list">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="transaction-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>No.HP</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach($datareq as $d)
                                <tr>
                                    
                                    <td>{{$d->nama}}</td>
                                    <td>{{$d->no_hp}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>{{$d->alamat}}</td>
                                    <td>{{$d->role}}</td>
                                    @if($d->request_penyelenggara == '2')
                                    <td><button class="btn-danger mr-0 mr-sm-1 mb-1 mb-sm-0 " style="color: white">Ditolak</button></td>
                                    @elseif($d->request_penyelenggara == '3')
                                    <td><button class="btn-success mr-0 mr-sm-1 mb-1 mb-sm-0 " style="color: white">Divalidasi</button></td>
                                    @elseif($d->request_penyelenggara == '1')
                                    <td><button class="btn-warning mr-0 mr-sm-1 mb-1 mb-sm-0 " style="color: white">Menunggu</button></td>
                                    @elseif($d->request_penyelenggara == '0')
                                    <td><button class="btn-light mr-0 mr-sm-1 mb-1 mb-sm-0 " style="color: white">Peserta</button></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody> 
                        </table>
                    </div>
                </div>
            </section>
        </div>



    </div>
</div>
<!-- END: Content-->
@endsection

@section('js')
<script src="{{ asset('app-assets/js/scripts/pages/app-user-request-list-custom.js') }}"></script>
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