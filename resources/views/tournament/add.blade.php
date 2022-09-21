@extends('layouts.main')

@section('title') Posting Tournament @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-blog.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-quill-editor.css') }}">
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
                        <h2 class="content-header-title float-left mb-0">Tournament</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Posting Tournament
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Blog Edit -->
            <div class="blog-edit-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar mr-75">
                                        @if(Auth::user()->foto == '' || Auth::user()->foto == null)
                                        <img src="{{ asset('images/default.jpg') }}" width="38" height="38" alt="Avatar" />
                                        @else
                                        <img src="{{ asset('images/profile/'.Auth::user()->foto) }}" width="38" height="38" alt="Avatar" />
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-25 text-capitalize">{{ Auth::user()->nama }}</h6>
                                        <p class="card-text">{{ tanggal_indonesia($date) }}</p>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!-- Form -->
                                <form action="" class="mt-2" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="judul">Nama</label>
                                                <input type="text" id="judul" class="form-control" name="nama" placeholder="nama tournament" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-category">Jumlah Slot</label>
                                                <input type="number" class="form-control" name="jumlah_slot" placeholder="jumlah slot" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-slug">Lokasi</label>
                                                <input type="text" class="form-control" name="lokasi" placeholder="lokasi tournament" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-status">Type</label>
                                                <select name="type" id="" class="form-control" required>
                                                    <option value="solo">Solo</option>
                                                    <option value="duo">Duo</option>
                                                    <option value="squad" selected>Squad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-status">Terakhir Pendaftaran</label>
                                                <input type="date" class="form-control" name="tgl_valid" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-status">Biaya Pendaftaran (Rp)</label>
                                                <input type="number" class="form-control" name="biaya_pendaftaran" placeholder="biaya" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-status">Tanggal Tournament</label>
                                                <input type="date" class="form-control" name="tgl_tournament" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="blog-edit-status">No. Rekening (Admin)</label>
                                                <input type="text" class="form-control" value="{{ $setting->info_bank }}"  readonly/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label>Deskripsi</label>
                                                <div id="blog-editor-wrapper">
                                                    <div id="blog-editor-container">
                                                        <input type="hidden" id="konten" name="deskripsi">
                                                        <div class="editor" id="editor">
                                                            <p>
                                                                ketikkan sesuatu disini...
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-2">
                                            <div class="border rounded p-2">
                                                <h4 class="mb-1">Thumbnail Tournament</h4>
                                                <div class="media flex-column flex-md-row">
                                                    <div class="media-body">
                                                        <small class="text-muted">Recommended image resolution 800x400,<br>max image size 2mb.</small>
                                                        <p class="my-50">
                                                            <a href="javascript:void(0);" id="blog-image-text"></a>
                                                        </p>
                                                        <div class="d-inline-block">
                                                            <div class="form-group mb-0">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="thumbnail" required/>
                                                                    <label class="custom-file-label">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-2">
                                            <div class="border rounded p-2">
                                                <h4 class="mb-1">File Tournament</h4>
                                                <div class="media flex-column flex-md-row">
                                                    <div class="media-body">
                                                        <small class="text-muted">File tournament (poster or document),<br>max file size 2mb.</small>
                                                        <p class="my-50">
                                                            <a href="javascript:void(0);" id="blog-image-text"></a>
                                                        </p>
                                                        <div class="d-inline-block">
                                                            <div class="form-group mb-0">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="file_poster" required/>
                                                                    <label class="custom-file-label" for="blogCustomFile">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-50">
                                            <button type="submit" class="btn btn-primary mr-1">Posting</button>
                                            <!-- <button type="reset" class="btn btn-outline-secondary">Batal</button> -->
                                        </div>
                                    </div>
                                </form>
                                <!--/ Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Blog Edit -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('js')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/page-blog-edit.js') }}"></script>

<script>
    $('.editor').keyup(function() {
        var konten = $('.ql-editor').html();

        $('#konten').val(konten);
    });

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
    Swal.fire({
        // position: 'top-end',
        icon: 'error',
        title: '{{ $message }}',
        showConfirmButton: false,
        timer: 2000,
        customClass: {
          confirmButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
</script>
@endif
@endsection