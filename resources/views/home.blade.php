@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile pb-3 shadow">
    <div class="background-profile">
        <p><i class="nav-icon ms-3 mt-3 fa fa-address-card"> </i> {{ Auth::user()->role }} : <b class="text-success fw-bold">{{ Auth::user()->status }}</b></p>
    </div>
    <div class="card-body mx-5 d-flex justify-content-between">
        <div class="title">
            @if (Auth::user()->image)
                <img src="{{ asset('storage/avatars/' . Auth::user()->image )}}" class="img-profile rounded-circle" height="180" width="180">
                @else
                <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1" class="img-profile rounded-circle" height="180" width="180">
            @endif
            
            <h1 class="profile-title">{{ Auth::user()->name }}</h1>
            <p class="card-text text-muted fs-5">{{ Auth::user()->alamat }}</p>
            <p class="card-text">{{ Auth::user()->email }}  <b>{{ Auth::user()->role }}</b>  <i>{{ Auth::user()->tanggal_lahir }}</i></p>
        </div>
        <div class="button">
            <a href="{{ route('my.profile.index') }}" class="btn btn-large btn-primary rounded-3">Edit Profile</a>
        </div>
    </div>
    </div>
</div>
@endsection
