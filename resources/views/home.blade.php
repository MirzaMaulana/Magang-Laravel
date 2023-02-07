@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ asset('storage/'. Auth::user()->image) }}" alt="">
    <h1>Name         : {{ Auth::user()->name }}</h1>
    <h2>Email        : {{ Auth::user()->email }}</h2>
    <h2>Tanggal Lahir: {{ Auth::user()->tanggal_lahir }}</h2>
    <h2>Jenis Kelamin: {{ Auth::user()->jenis_kelamin }}</h2>
    <h2>alamat       : {{ Auth::user()->alamat }}</h2>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
