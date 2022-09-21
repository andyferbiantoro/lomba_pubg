@extends('layouts.main')

@section('title') User @endsection

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
                        <h2 class="content-header-title float-left mb-0">User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User
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
                                    <th>Peserta</th>
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

        <div class="content-body">
            <section class="app-user-list">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="penyelenggara-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Penyelenggara</th>
                                    <th>No.HP</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Alamat</th>
                                    <th>Maks. Tournament</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
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
<script src="{{ asset('app-assets/js/scripts/pages/app-user-list-custom.js') }}"></script>
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
    // alert("test");
    // $(document).ready(function() {
    //     $('.toggleActive').change(function() {
    //         alert('test');
    //         var status = $(this).prop('checked') == true ? 1 : 0; 
    //         var user_id = $(this).data('id'); 
    //         var url = '/user/status-penyelenggara/'+user_id;
    
    //         console.log('kdsd');
    //         $.ajaxSetup({
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    
    //         $.ajax({
    //             type: "POST",
    //             url: url,
    //             data: {status: status},
    //             success: function (result) {
    //                 console.log('success update status penyelenggara');
    //             }
    //         });
    //     });
    // });

</script>

@endsection