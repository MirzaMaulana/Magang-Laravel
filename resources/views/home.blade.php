@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="profile pb-3 shadow mx-5">
            <div class="background-profile" style="background-image: url({{ asset('css/img/background.jpg') }})">
            </div>
            <div class="card-body d-flex justify-content-center">
                @if (Auth::user()->image)
                    <img src="{{ asset('storage/avatars/' . Auth::user()->image) }}" class="img-profile rounded-circle"
                        style="border: 5px solid rgb(247, 247, 247);" height="180" width="180">
                @else
                    <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                        class="img-profile rounded-circle" height="180" width="180">
                @endif
                <div class="title text-center pt-3">
                    <p class="profile-title text-disable">{{ Auth::user()->alamat }}</p>
                    <h1 class="fw-bold">{{ Auth::user()->name }}</h1>
                    <p class="card-text text-center">{{ Auth::user()->role }}
                    </p><a href="{{ route('my.profile.index') }}" class="fw-bold btn btn-success rounded-5 px-4">More
                        Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
