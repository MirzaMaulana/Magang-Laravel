@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile pb-3 shadow-sm">
    <div class="background-profile"></div>
    <div class="card-body mx-5 d-flex justify-content-between">
        <div class="title">
            <img src="{{ asset('storage/avatars/' . Auth::user()->image )}}" class="img-profile rounded-circle" width="180">
            <h1 class="profile-title">{{ Auth::user()->name }}</h1>
            <p class="card-text text-muted fs-5">{{ Auth::user()->alamat }}</p>
            <p class="card-text">{{ Auth::user()->email }} - <b>{{ Auth::user()->role }}</b> - <i>{{ Auth::user()->tanggal_lahir }}</i></p>
        </div>
        <div class="button m-5">
            <a href="/update" class="btn btn-large btn-primary">Edit Profile</a>
        </div>
    </div>
    </div>
    {{-- <h1>Name         : {{ Auth::user()->name }}</h1>
    <h2>Email        : {{ Auth::user()->email }}</h2>
    <h2>Tanggal Lahir: {{ Auth::user()->tanggal_lahir }}</h2>
    <h2>Jenis Kelamin: {{ Auth::user()->jenis_kelamin }}</h2>
    <h2>alamat       : {{ Auth::user()->alamat }}</h2>
    <img src="{{ asset('storage/avatars/' . Auth::user()->image )}}"> --}}
</div>
@endsection
