@extends('layouts.main')

@section('title') Profile @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">

<style>
    .bukti {
        display: none;
    }
</style>
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
                        <h2 class="content-header-title float-left mb-0">Profile</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active"> Pengaturan Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Umum</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Ganti Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- header media -->
                                        <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">
                                                @if($user->foto == '' || $user->foto == null)
                                                <img src="{{ asset('images/default.jpg') }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                                @else
                                                <img src="{{ url('storage/images/profile/'.$user->foto) }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                                @endif
                                            </a>
                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <form action="{{ url('/profile/update-foto') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <input type="file" id="account-upload" name="foto" hidden onchange="this.form.submit()" accept="image/*" />
                                                </form>
                                                <!-- <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button> -->
                                                <p>Allowed JPG, JPEG, PNG. Max size 2MB</p>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <!--/ header media -->

                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-2">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <!-- form -->
                                        <form class="validate-form mt-2" action="{{ url('/profile/update-general') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-username">Nama</label>
                                                        <input type="text" class="form-control" id="account-username" name="nama" placeholder="Nama Lengkap" value="{{ $user->nama }}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">No. Hp</label>
                                                        <input type="number" class="form-control" name="no_hp" placeholder="Nomor Hp" value="{{ $user->no_hp }}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">E-mail</label>
                                                        <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="{{ $user->email }}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Role <span class="text-uppercase">({{ $user->role }})</span></label>
                                                        @if($user->role == 'peserta')
                                                            <select onchange="showbukti()" name="request_penyelenggara" id="req-penyelenggara" class="form-control">
                                                                <option selected disabled>Pilih Aksi</option>
                                                                <option value="1">Request Penyelenggara</option>
                                                            </select>

                                                            <div class="mt-1 bukti">
                                                                <label for="">Bukti Transfer</label>
                                                                <input type="file" name="bukti_tf" class="form-control">
                                                                <h6 class="mt-2">Biaya menjadi penyelenggara : <span class="text-info">Rp {{ number_format($setting->daftar_penyelenggara, 0, '.', '.') }}</span></h6>
                                                                <h6 class="">Info Bank : <span class="text-info">{{ $setting->info_bank }}</span></h6>
                                                            </div>
                                                            @if($user->request_penyelenggara == 0)
                                                            <small class="text-warning">Jika ingin menjadi PENYELENGGARA tournament, bisa request kepada admin dengan cara pilih aksi diatas.</small>
                                                            @elseif($user->request_penyelenggara == 2)
                                                            <small class="text-danger">Mohon Maaf, permintaan anda menjadi penyelenggara ditolak oleh admin. Mohon periksa kembali persyaratan yang diperlukan.</small>
                                                            @else
                                                            <small class="text-info">Anda sudah meminta menjadi PENYELENGGARA, tunggu validasi dari Admin.</small>
                                                            @endif
                                                        @else
                                                            <h1 class="text-capitalize">{{ Auth::user()->role }}</h1>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountTextarea">Alamat</label>
                                                        <textarea class="form-control" id="accountTextarea" rows="4" placeholder="Alamat..." name="alamat" required>{{ $user->alamat }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-75">
                                                    <div class="alert alert-warning mb-50" role="alert">
                                                        @if($user->email_verified_at == null)
                                                        <h4 class="alert-heading">Email anda belum terverifikasi.</h4>
                                                        <div class="alert-body">
                                                            <a href="{{ url('/email/verify') }}" target="_blank" class="alert-link">Kirim email verifikasi</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Simpan</button>
                                                    <!-- <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button> -->
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form" method="post" action="{{ url('/profile/update-password') }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-old-password">Password Lama</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-old-password" name="old_password" placeholder="Password Lama" required/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-new-password">Password Baru</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" id="account-new-password" name="password" class="form-control" placeholder="Password Baru" required/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-retype-new-password">Ulangi Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-retype-new-password" name="password_confirmation" placeholder="Ulangi Password" required/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mt-1">Simpan</button>
                                                    <!-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> -->
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->

                                    <!-- information -->
                                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountTextarea">Bio</label>
                                                        <textarea class="form-control" id="accountTextarea" rows="4" placeholder="Your Bio data here..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-birth-date">Birth date</label>
                                                        <input type="text" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="accountSelect">Country</label>
                                                        <select class="form-control" id="accountSelect">
                                                            <option>USA</option>
                                                            <option>India</option>
                                                            <option>Canada</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-website">Website</label>
                                                        <input type="text" class="form-control" name="website" id="account-website" placeholder="Website address" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-phone">Phone</label>
                                                        <input type="text" class="form-control" id="account-phone" placeholder="Phone number" value="(+656) 254 2568" name="phone" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ information -->

                                    <!-- notifications -->
                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <div class="row">
                                            <h6 class="section-label mx-1 mb-2">Activity</h6>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                                                    <label class="custom-control-label" for="accountSwitch1">
                                                        Email me when someone comments onmy article
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                                                    <label class="custom-control-label" for="accountSwitch2">
                                                        Email me when someone answers on my form
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                                                    <label class="custom-control-label" for="accountSwitch3">Email me hen someone follows me</label>
                                                </div>
                                            </div>
                                            <h6 class="section-label mx-1 mt-2">Application</h6>
                                            <div class="col-12 mt-1 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                                                    <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                                                    <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-75">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                                                    <label class="custom-control-label" for="accountSwitch5">Weekly blog digest</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ notifications -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('js')
    <script>
        function showbukti()
        {
            $('.bukti').css({'display': 'block'});
        }
    </script>
    @if($message = Session::get('success'))
    <script>
        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2000,
            customClass: {
            confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    </script>
    @endif

    @if($message = Session::get('error'))
    <script>
        toastr.error('{{ $message }}', {timeOut: 3000})
    </script>
    @endif
@endsection