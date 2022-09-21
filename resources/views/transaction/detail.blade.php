@extends('layouts.main')

@section('title') Detail Transaksi @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
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
                        <h2 class="content-header-title float-left mb-0">Transaksi</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Detail Transaksi & Invoice
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img src="{{ asset('logo.png') }}" style="max-width: 40px">
                                            <h5 class="text-primary invoice-logo">PUBG ESPORTS</h5>
                                        </div>
                                        <p class="card-text mb-25">Email primapangestu66@gmail.com</p>
                                        <p class="card-text mb-25">Phone +(62) 877 6251 5136</p>
                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            <span class="invoice-number text-uppercase">#{{ $transaksi->status }}</span>
                                        </h4>
                                        <!-- <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date Issued:</p>
                                            <p class="invoice-date">25/08/2020</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Due Date:</p>
                                            <p class="invoice-date">29/08/2020</p>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">Invoice Untuk:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Perserta:</td>
                                                    <td><span class="font-weight-bold">{{ $peserta->nama }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Team:</td>
                                                    <td>{{ $transaksi->team }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">No HP:</td>
                                                    <td>{{ $peserta->no_hp }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Email:</td>
                                                    <td>{{ $peserta->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Alamat:</td>
                                                    <td>{{ $peserta->alamat }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Invoice Dari:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Penyelenggara:</td>
                                                    <td><span class="font-weight-bold">{{ $penyelenggara->nama }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">No HP:</td>
                                                    <td>{{ $penyelenggara->no_hp }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Email:</td>
                                                    <td>{{ $penyelenggara->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Alamat:</td>
                                                    <td>{{ $penyelenggara->alamat }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Invoice Description starts -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">Tournament</th>
                                            <th></th>
                                            <th></th>
                                            <th class="py-1">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">{{ $tournament->nama }}</p>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">Rp {{ number_format($tournament->biaya_pendaftaran, 0, '.', '.') }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <!-- <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <p class="card-text mb-0">
                                            <span class="font-weight-bold">Salesperson:</span> <span class="ml-75">Alfie Solomons</span>
                                        </p>
                                    </div> -->
                                    <div class="col-md-12 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount">Rp {{ number_format($tournament->biaya_pendaftaran, 0, '.', '.') }}</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Pajak:</p>
                                                <p class="invoice-total-amount">0</p>
                                            </div>
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount">Rp {{ number_format($tournament->biaya_pendaftaran, 0, '.', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing" />

                            <!-- Invoice Note starts -->
                            <!-- <div class="card-body invoice-padding pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="font-weight-bold">Note:</span>
                                        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                            projects. Thank You!</span>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                @if($transaksi->bukti != null && $transaksi->bukti != '')
                                    <a href="{{ url('storage/images/transaksi/bukti/'.$transaksi->bukti) }}" class="btn btn-primary btn-block mb-75" target="_blank" rel="noopener noreferrer">
                                        Lihat Bukti
                                    </a>    
                                @else
                                    <a href="#" class="btn btn-secondary btn-block mb-75" disabled>
                                        Lihat Bukti
                                    </a>    
                                @endif
                                <!-- <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Download</button>
                                <a class="btn btn-outline-secondary btn-block mb-75" href="#" target="_blank">
                                    Print
                                </a> -->
                                @if(Auth::user()->role != 'peserta' && Auth::user()->role != 'penyelenggara')
                                    @if($transaksi->status == 'waiting')
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ url('transaksi/detail/'.$transaksi->id_transaksi.'/reject') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-danger btn-block" type="submit">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ url('transaksi/detail/'.$transaksi->id_transaksi.'/valid') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-success btn-block" type="submit">
                                                    Valid
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                @if(Auth::user()->id_user != $tournament->id_penyelenggara)
                                    @if($transaksi->status == 'pending' || $transaksi->status == 'reject')
                                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#upload-sidebar">
                                        Upload Bukti
                                    </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
            </section>

            <!-- Upload Bukti Sidebar -->
            <div class="modal modal-slide-in fade" id="upload-sidebar" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Upload Bukti</span>
                            </h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <form action="{{ url('transaksi/detail/'.$transaksi->id_transaksi.'/upload-bukti') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <input type="file" class="form-control" name="bukti" required/>
                                </div>
                                
                                <div class="form-group d-flex flex-wrap mt-2">
                                    <button type="submit" class="btn btn-primary mr-1">Upload</button>
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Send Invoice Sidebar -->

            <!-- Add Payment Sidebar -->
            <div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Add Payment</span>
                            </h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <form>
                                <div class="form-group">
                                    <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="amount">Payment Amount</label>
                                    <input id="amount" class="form-control" type="number" placeholder="$1000" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="payment-date">Payment Date</label>
                                    <input id="payment-date" class="form-control date-picker" type="text" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="payment-method">Payment Method</label>
                                    <select class="form-control" id="payment-method">
                                        <option value="" selected disabled>Select payment method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Paypal">Paypal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="payment-note">Internal Payment Note</label>
                                    <textarea class="form-control" id="payment-note" rows="5" placeholder="Internal Payment Note"></textarea>
                                </div>
                                <div class="form-group d-flex flex-wrap mb-0">
                                    <button type="button" class="btn btn-primary mr-1" data-dismiss="modal">Send</button>
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Payment Sidebar -->

        </div>
    </div>
</div>

<!-- END: Content-->
@endsection

@section('js')
<script src="{{ asset('app-assets/js/scripts/pages/app-invoice.js') }}"></script>

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

@if($message = Session::get('failed'))
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