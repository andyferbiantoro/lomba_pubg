@extends('auth.main')

@section('title') Login @endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
        <!-- Login v1 -->
        <div class="card mb-0">
            <div class="card-body">
                <a href="{{ url('/') }}" class="brand-logo">
                    <img src="{{ asset('logo.png') }}" alt="">
                    <!-- <h2 class="brand-text text-primary ml-1">PUBG Esports</h2> -->
                </a>

                <h4 class="card-title mb-1">Selamat Datang di PUBG Esports! 👋</h4>
                <p class="card-text mb-2">Silakan masuk ke akun Anda dan mulai petualangan</p>

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="login-email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="login-email" name="email" placeholder="akun@contoh.com" aria-describedby="login-email" tabindex="1" autofocus required />
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" autofocus required />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">Masuk</button>
                </form>

                <p class="text-center mt-2">
                    <span>Pengguna baru?</span>
                    <a href="{{ url('/register') }}">
                        <span>buat akun</span>
                    </a>
                </p>

                <div class="divider my-2">
                    <div class="divider-text">atau</div>
                </div>

                <div class="auth-footer-btn d-flex justify-content-center">
                    <a href="{{ url('auth/google') }}" class="btn btn-google">
                        <i data-feather="mail"></i> Google
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login v1 -->
    </div>
</div>
@endsection