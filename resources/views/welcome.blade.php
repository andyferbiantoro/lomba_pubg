@extends('layouts.main')

@section('title') Home @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('app-assets/vendors/owlcarousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/vendors/owlcarousel/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        <div class="alert-body"><strong>PUBG ESPORTS:</strong> Platform penyedia info lomba game PUBG</div>
                    </div>
                </div>
            </div>

            <section id="dashboard-analytics">
                <div class="row match-height">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <div id="owl-banner" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="{{ asset('images/banner/1.jpg') }}" class="img-fluid">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/banner/2.png') }}" class="img-fluid">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/banner/3.jpg') }}" class="img-fluid">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/banner/4.jpg') }}" class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <hr>
            <section class="faq-contact">
                <div class="row mt-5 pt-75">
                    <div class="col-12 text-center">
                        <h2>Apa yang harus kita pahami sebagai peserta dan penyelenggara?</h2><br><br>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1">
                            <div class="card-body">
                               
                                <h4>Sebagai Peserta</h4><br>
                                <div class="text-left">
                                    <ul>
                                        <li>Membaca SK turnamen dengan teliti</li>
                                        <li>Link room akan dibagikan diturnamen yang diikuti 10 menit sebelum turnamen dimulai</li>
                                        <li>Setelah turnamen selesai hadiah akan dikirim ke nomor rekening pemenang</li>
                                        <br><br><br>
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1">
                            <div class="card-body">
                                
                                <h4>Sebagai Penyelenggara</h4><br>
                                <div class="text-left">
                                    <ul>
                                        <li>Membuat turnamen dengan ketentuan 4 kali posting/bulan dengan biaya yang tertera</li>
                                        <li>setelah mengirimkan uang, penyelenggara segera menghubungi admin nomor whatsapp yang tertera)</li>
                                        <li>Jika ingin memperpanjang menjadi penyelenggara silahkan menghubungi admin</li>
                                        <li>Penyelenggara tidak bisa mengikuti turnamen</li>
                                        <li>Setelah turnamen selesai, penyelenggara harus mengirimkan nama pemenang pada fitur pemenang</li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
            <hr>

            <div class="content-detached content-center">
                    <div class="content-body">
                        <!-- Blog List -->
                        <div class="blog-list-wrapper">
                            <!-- Blog List Items -->
                            <div class="row px-150">
                                <div class="col-12 text-center mt-5 mb-3">
                                    <h2>Informasi Tournament Terbaru</h2>
                                </div>
                                
                                @foreach($data as $d)
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="#" class="blog-title-truncate text-body-heading">{{ $d->nama }}</a>
                                            </h4>
                                            <div class="media">
                                                <div class="avatar mr-50">
                                                    @if($d->penyelenggara->foto == '' || $d->penyelenggara->foto == null)
                                                        <img src="{{ asset('images/default.jpg') }}" alt="Avatar" width="24" height="24" />
                                                    @else
                                                        <img src="{{ url('storage/images/profile/'.$d->penyelenggara->foto) }}" alt="Avatar" width="24" height="24" />
                                                    @endif
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted mr-25">by</small>
                                                    <small><a href="javascript:void(0);" class="text-body">{{ $d->penyelenggara->nama }}</a></small>
                                                    <span class="text-muted ml-50 mr-25">|</span>
                                                    <small class="text-muted">{{ tanggal_indonesia($d->tgl_valid) }}</small>
                                                </div>
                                            </div>
                                            <div class="my-1 py-25">
                                                <a href="javascript:void(0);">
                                                    <div class="badge badge-pill badge-light-danger mr-50">Gaming</div>
                                                </a>
                                                <a href="javascript:void(0);">
                                                    <div class="badge badge-pill badge-light-warning">Pubg</div>
                                                </a>
                                            </div>
                                            <p class="card-text blog-content-truncate">
                                                {{ strip_tags($d->deskripsi) }}
                                            </p>
                                            <hr />
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <i data-feather="info" class="font-medium-1 text-body mr-50"></i>
                                                        <span class="text-body font-weight-bold">Tersedia {{ $d->sisa_slot }} / {{ $d->jumlah_slot }} Slot</span>
                                                    </div>
                                                </a>
                                                <a href="{{ url('tournament/detail/'.$d->slug) }}" class="font-weight-bold">Detail</a>
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
                                    
                                </div>
                            </div>
                            <!--/ Pagination -->
                        </div>
                        <!--/ Blog List -->

                    </div>
                </div>

            <section class="faq-contact">
                <div class="row mt-5 pt-75">
                    <div class="col-12 text-center">
                        <h2>Anda masih memiliki pertanyaan?</h2>
                        <p class="mb-3">
                            Anda selalu dapat menghubungi kami. Kami akan segera menjawab Anda!
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1">
                            <div class="card-body">
                                <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                    <i data-feather="phone-call" class="font-medium-3"></i>
                                </div>
                                <h4>+ (62) 877 6251 5136</h4>
                                <span class="text-body">Cara terbaik untuk mendapatkan jawaban lebih cepat!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1">
                            <div class="card-body">
                                <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                    <i data-feather="mail" class="font-medium-3"></i>
                                </div>
                                <h4>primapangestu66@gmail.com</h4>
                                <span class="text-body">Kami selalu senang membantu!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard end -->

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('app-assets/vendors/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('app-assets/vendors/owlcarousel/owl.carousel.min.js') }}"></script>

<script>
    $(document).ready(function() {
      $("#owl-banner").owlCarousel({
        items: 2,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout:2000,
        navigation: true
      });
     
    });
</script>
@endsection