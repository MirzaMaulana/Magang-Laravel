@extends('index.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-5">
                <h1 class="text-center" style="font-family: Roboto Slab"><img
                        src="https://th.bing.com/th/id/OIP.D2b5o5AIYbd0pkt0O73mAQHaHa?pid=ImgDet&w=640&h=640&rs=1"
                        width="50" height="50" class="d-inline-block align-top" alt="">
                    Tebarin Berita</h1>
                <h5 class="text-center">Register and let's get started</h5>
                <div class="card border-0">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <input id="name" type="text"
                                    class="py-2 form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <input id="email" type="email"
                                    class="py-2 form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">

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
                                    class="py-2 form-control @error('password') is-invalid @enderror" name="password"
                                    required placeholder="Password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}


                                <input id="password-confirm" placeholder="Confirm Password" type="password"
                                    class="py-2 form-control" name="password_confirmation" required
                                    autocomplete="new-password">

                            </div>

                            <div class="row mb-0">

                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/submit.js') }}"></script>
@endpush
