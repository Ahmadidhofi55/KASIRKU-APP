@include('sweetalert::alert')
@extends('layout.log')
@section('title', 'KASIRKU')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url({{ asset('images/kasir_bg.png') }});"></div>
                    <div class="login-wrap p-1 p-md-1">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4 font-weight-bold text-center">KASIRKU</h3>
                            </div>
                        </div>
                        <form method="POST" class="signin-form" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <input placeholder="email" id="email" type="email"
                                    class="form-control  @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input placeholder="password" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-login font-weight-bold btn-block btn-info">
                                    {{ __('LOGIN') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
