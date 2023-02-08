<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="css/welcome.css">
    </head>
    <body>
            @if (Route::has('login'))
                <div class="container my-3">
                    @auth
                        <a href="{{ url('/home') }}" class="text-end text-dark fs-5">Home</a>
                    @else
                <div class="mx-auto card rounded-5 py-4 mt-5 shadow container" style="width: 30rem">
                <div class="card-body">
                   <h4 class="card-title text-center">Agent Login</h4>
                   <p class="card-subtitle mb-2 text-muted text-center">Hey, enter your details for <br> sign in to your account</p>
                   <form method="POST" action="{{ route('login') }}" class="mt-4 mx-4">
                        @csrf
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password" type="password" class="form-control mt-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                             </label> 
                             {{-- <div class="text-center ms-2" style="margin-top: -8px">
                             @if (Route::has('password.request'))
                                     <a class="btn btn-link " href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif 
                        </div> --}}
                        </div>
                      
                        <div class="submit mt-3 text-center">
                            <button type="submit" class=" btn btn-primary">
                            {{ __('Login') }}
                            </button>
                        </div>
                        
                        <div class="text-center my-3">
                            <p>Not a member? <a href="{{ route('register') }}">Register</a></p>
                       </div>
                        
                    </form>
                </div>
            </div>
                    @endauth
                </div>
            @endif

            
    </body>
</html>
