@extends('auth.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <h1 class="text-center" style="font-family: Roboto Slab"><img
                        src="https://th.bing.com/th/id/OIP.D2b5o5AIYbd0pkt0O73mAQHaHa?pid=ImgDet&w=640&h=640&rs=1"
                        width="50" height="50" class="d-inline-block align-top" alt="">
                    Tebarin Berita</h1>
                <div class="card border-0">
                    @if (session()->has('error'))
                        <div class="alert alert-danger absolute alert-dismissible fade show container" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                {{-- <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror py-2" name="email"
                                    value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}


                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror py-2" name="password"
                                    required placeholder="Password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="" style="margin-top:-10px ">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>

                            </div>
                            <hr>
                            <div class="row text-center">
                                <p>Don't have an account? <a href="{{ route('register') }}"
                                        class="fw-bold text-decoration-none text-success">Register Here.</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/submit.js') }}"></script>
@endsection
