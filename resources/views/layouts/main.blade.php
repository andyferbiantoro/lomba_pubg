<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PUBG">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    @livewireStyles

    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed navbar-shadow">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <span class="brand-logo ml-3">
                            <img src="{{ asset('logo.png') }}" style="max-width: 40px">
                        </span>
                        <h3 class="brand-text mb-0 ml-1 text-uppercase">Pubg Esports</h3>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
                <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                    <div class="search-input">
                        <!-- <div class="search-input-icon"><i data-feather="search"></i></div> -->
                        <!-- <input class="form-control input" wire:model="search" type="text" placeholder="Cari Tournament.." tabindex="-1" data-search="search">
                            <div class="search-input-close"><i data-feather="x"></i></div> -->
                            <div class="search-input-close"><i data-feather="x"></i></div>

                            <!-- <ul class="search-list search-list-main"></ul> -->
                            
                            @livewire('search-tournament')
                        </div>
                    </li>
                <!-- <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="badge badge-pill badge-light-primary">6 New</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-3.jpg') }}" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content">MD</div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                    </div>
                                </div>
                            </a>
                            
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li> -->
                <li class="nav-item dropdown dropdown-user">
                    @auth
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <div class="user-nav d-sm-flex d-none">
                                <span class="user-name font-weight-bolder">Admin</span><span class="user-status">Admin</span>
                            </div> -->
                            <span class="avatar">
                                @if(Auth::user()->foto == '' || Auth::user()->foto == null)
                                <img class="round" src="{{ asset('images/default.jpg') }}" alt="avatar" height="40" width="40">
                                @else
                                <img class="round" src="{{ url('storage/images/profile/'.Auth::user()->foto) }}" alt="avatar" height="40" width="40">
                                @endif
                                <span class="avatar-status-online"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="{{ url('/profile') }}">
                                <i class="mr-50" data-feather="user"></i> Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                    <i class="mr-50" data-feather="power"></i> Logout
                                </a>
                            </form>
                        </div>
                        @endauth
                        @guest
                        <a class="btn btn-primary ml-50" href="{{ url('/login') }}">
                            <i class="mr-50" data-feather="log-in"></i> Login
                        </a>
                        @endguest
                    </li>
                </ul>
            </div>
        </nav>

        <ul class="main-search-list-defaultlist-other-list d-none">
            <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>Tidak ditemukan.</span></div>
            </a></li>
        </ul>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="horizontal-menu-wrapper">
            <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-dark navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item mr-auto">
                            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                                <span class="brand-logo ml-3">
                                    <img src="{{ asset('logo.png') }}" style="max-width: 40px">
                                </span>
                                <h3 class="brand-text mb-0 ml-1 text-uppercase">Pubg Esports</h3>
                            </a>
                        </li>
                        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
                    </ul>
                </div>
                <div class="shadow-bottom"></div>
                <!-- Horizontal menu content-->
                <div class="navbar-container main-menu-content" data-menu="menu-container">
                    <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                        <li class="dropdown nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/') }}">
                                <i data-feather="home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item {{ (request()->is('news*')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/news') }}">
                                <i data-feather="file-text"></i>
                                <span>Berita</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item {{ (request()->is('tournament*')) ? 'active' : '' }}"><a class="d-flex align-items-center">
                            <i data-feather="info"></i>
                            <span>Tournament</span>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="{{ url('/tournament') }}" data-toggle="dropdown">Semua Tournament</a>
                                </li>
                                @auth
                                @if(Auth::user()->role == 'peserta')
                                <li data-menu=""><a class="dropdown-item" href="{{ url('/tournament/follow') }}" data-toggle="dropdown">Tournament Diikuti</a>
                                </li>
                                @endif
                                @endauth
                                @if(Auth::guest())
                                <li data-menu=""><a class="dropdown-item" href="{{ url('/tournament/follow') }}" data-toggle="dropdown">Tournament Diikuti</a>
                                </li>
                                @endif
                                
                            </ul>
                        </li>
                        <li class="dropdown nav-item {{ (request()->is('pemenang*')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/pemenang') }}">
                                <i data-feather="gift"></i>
                                <span>Pemenang</span>
                            </a>
                        </li>
                        @auth
                       
                        <li class="dropdown nav-item {{ (request()->is('transaksi*')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/transaksi') }}">
                                <i data-feather="clipboard"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                       
                        
                        @if(Auth::user()->role == 'admin')
                        <li class="dropdown nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/user') }}">
                                <i data-feather="user"></i>
                                <span>User</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item {{ (request()->is('request-penyelenggara*')) ? 'active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ url('/request-penyelenggara') }}">
                                <i data-feather="user-check"></i>
                                <span>Request Penyelenggara</span>
                            </a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        @yield('content')
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light footer-shadow">
            <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25"></p>
            </footer>
            <footer class="footer footer-static footer-light footer-shadow">
                <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022</p>
                </footer>
                <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
                <!-- END: Footer-->


                <!-- BEGIN: Vendor JS-->
                <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
                <!-- BEGIN Vendor JS-->

                <!-- BEGIN: Page Vendor JS-->
                <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
                <!-- <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script> -->
                <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
                <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
                <!-- END: Page Vendor JS-->

                <!-- BEGIN: Theme JS-->
                <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
                <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
                <!-- END: Theme JS-->

                <!-- BEGIN: Page JS-->
                <!-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script> -->
                <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-list.js') }}"></script>
                <script src="{{ asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
                <!-- END: Page JS-->

                @livewireScripts

                @yield('js')

                <script>
                    $(window).on('load', function() {
                        if (feather) {
                            feather.replace({
                                width: 14,
                                height: 14
                            });
                        }
                    })
                </script>
            </body>
            <!-- END: Body-->

            </html>