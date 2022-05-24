@extends('layouts.main')

@section('container')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin">
                <form action="/login" method="POST">
                    @csrf

                    <h1 class="h3 mb-3 fw-normal text-center">Silahkan Login</h1>
                
                    <div class="form-floating">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingUsername" placeholder="username" name="username" value="{{ old('username') }}" required>
                        <label for="floatingUsername">Username</label>

                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    
                    <a class="btn btn-link text-center w-100" href="/forget-password">Lupa password anda?</a>

                </form>
            </main>
        </div>
    </div>
@endsection