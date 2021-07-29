@extends('layouts.app')

@section('content')



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white" style="background-color: #005ea3;">
                

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        <h2 class="text-center title-login">Login</h2>
                        @csrf

                        <div class="form-group row">
                            <label for="credential"
                                class="col-md-4 col-form-label text-md-right">Email/Username/NIP</label>

                            <div class="col-md-6">
                                <input id="credential" type="text"
                                    class="form-control @error('credential') is-invalid @enderror" name="credential"
                                    value="{{ old('credential') }}" required autocomplete="credential" autofocus>

                                @error('credential')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-outline-danger" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection