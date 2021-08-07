@extends('layouts.app')
@section('styles')
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card col col-xl-4 px-0 my-5" style="border-radius:8px;">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="card-header radius-10 bg__first-color px-0"
                style="border-radius: 8px 8px 0px 0px; background-color: #005ea3 ;">
                <div class="text-light px-4">
                    <div class="title">
                        <h4 class="text-left text-left">SINARSIP <br> Sistem Manajemen Arsip</h4>
                    </div>
                </div>
            </div>
            <div class="card-body px-2">
                <div class="col pt-3 ">
                    <label class="sr-only" for="inputEmail">Email/NIP</label>
                    <div class="input-group mb-2 mt-0">
                        <div class="input-group-prepend">
                            <div class="input-group-text border-0" style="background-color: #005ea3"><i
                                    class='bx bxs-user bx-sm text-white'></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="inputEmail" name="credential" placeholder="Email"
                            required>
                    </div>
                </div>
                <div class="col pt-2">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text border-0" style="background-color: #005ea3">
                                <i class='bx bxs-lock-alt bx-sm text-white'></i></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                            placeholder="Password" required>
                    </div>
                </div>
                <div class="col offset-md-1 pt-2 form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword"
                        onchange="showPass('inputPassword', 'showPassword')">
                    <label class="form-check-label" for="showPassword">Lihat Sandi</label>
                </div>
                <div class="col-sm-12 pt-4 offset-md-4">
                    <button class="btn px-3 text-white text-md-right" style="background-color: #005ea3;"
                        type="submit">Login</button>
                </div>
                <div class="col text-center py-3">
                    @if (Route::has('password.request'))
                    <p>Lupa Password? <a class="text__first-color font-weight-bold"
                            href="{{ route('password.request') }}">Reset</a></p>
                    @endif

                </div>
            </div>
    </div>
</div>

@endsection