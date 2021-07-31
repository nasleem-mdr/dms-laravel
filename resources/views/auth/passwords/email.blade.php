@extends('layouts.app')
@section('styles')
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
@section('content')


<div class="container d-flex justify-content-center">
    <div class="card col col-xl-4 px-0 my-5" style="border-radius:8px;">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="card-header radius-10 bg__first-color px-0"
                style="border-radius: 8px 8px 0px 0px; background-color: #005ea3 ;">
                <div class="text-light px-4">
                    <div class="title">
                        <h4 class="text-left text-center">Login Manajemen Arsip</h4>
                    </div>
                </div>
            </div>
            <div class="card-body px-2">
                <div class="col pt-3 ">
                    @if (session('status'))
                    <div class="alert alert-light" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <label class="sr-only" for="inputEmail">Email</label>
                    <div class="input-group mb-2 mt-0">
                        <div class="input-group-prepend">
                            <div class="input-group-text border-0" style="background-color: #005ea3"><i
                                    class='bx bxs-user bx-sm text-white'></i>
                            </div>
                        </div>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email"
                            required>
                    </div>
                </div>
                <div class="col-sm-12 pt-4 text-center">
                    <button class="btn text-white" style="background-color: #005ea3;" type="submit">Kirim
                        Link Reset Password</button>
                </div>
            </div>
    </div>
</div>

@endsection