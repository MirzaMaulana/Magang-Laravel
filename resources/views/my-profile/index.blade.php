@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="card-body">
                        <form action="{{ route('my.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', auth()->user()->name) }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_lahir" type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir) }}">

                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label for="jenis_kelamin"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        aria-label="Default select example" name="jenis_kelamin">
                                        <option
                                            {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'Laki-Laki' ? 'selected' : '' }}
                                            value="Laki-Laki">Laki-Laki</option>
                                        <option
                                            {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}
                                            value="Perempuan">Perempuan</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label for="alamat"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', auth()->user()->alamat) }}</textarea>

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 mt-4 col-form-label text-md-end">{{ __('Foto') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group my-3">
                                        @if (Auth::user()->image)
                                            <img id="profile" class="mx-2 img-thumbnail"
                                                src="{{ asset('storage/avatars/' . auth()->user()->image) }}"
                                                width="70">
                                        @else
                                            <img id="profile" class="mx-2 img-thumbnail"
                                                src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                                width="70">
                                        @endif

                                        <div>
                                            <input name="image" class="form-control @error('image') is-invalid @enderror"
                                                onchange="loadFile(event)" type="file" accept="image/*" id="formFile">
                                            <small for="formFile" class="form-label">Silahkan Upload Foto Anda</small>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let loadFile = function(event) {
            var image = document.getElementById('profile');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script src="{{ asset('js/submit.js') }}"></script>
@endsection
