@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center my-5">
    <div class="row ">
        <div class="col-md-12">
            <div class="card  text-white " style="background-color: #005ea3;">
                <div class="card-header">
                    <h2 class="text-center title-login">Reset Password</h2>
                </div>
                <div class="card-body pl-lg-5 pr-lg-5 pb-lg-5">
                    @if (session('status'))
                    <div class="alert alert-light" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <label for="email" class="col-md-8 col-form-label text-md-left">{{ __('E-Mail ') }}</label>
                        </div>

                        <div class="form-group row mt-0">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-light">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection