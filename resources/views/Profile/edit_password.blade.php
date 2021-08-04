@extends('layouts.back')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection



@section('content')

<div class="container d-flex justify-content-center">
  <div class="card col col-xl-6 px-0 my-5" style="border-radius:8px;">

    <div class="card-header radius-10 bg__first-color px-0"
    style="border-radius: 8px 8px 0px 0px; background-color: #005ea3 ;">
    <div class="text-light px-4">
        <div class="title">
            <h4 class="text-left text-left">Ubah Password</h4>
        </div>
    </div>
</div>
    <div class="card-body px-2">
    @if (session('error_message'))
    <div class="alert alert-danger">
      {{ session('error_message') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.reset_password') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="col pt-2">
        <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Kata Sandi Lama</label>

        <div class="col-md-12">
          <input id="oldPassword" type="password" class="form-control @error('old_password') is-invalid @enderror"
            name="old_password" required autocomplete="current-old_password">

          @error('old_password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <div class="col pt-2">
          <input type="checkbox" class="form-check-input" id="showOldPassword"
          onchange="showPass('oldPassword', 'showOldPassword')">
        <label class="form-check-label" for="showOldPassword">Lihat Kata Sandi Lama</label>
          </div>
        </div>
      </div>


      <div class="col pt-2">
        <label for="newPassword" class="col-md-4 col-form-label text-md-right">Kata Sandi Baru</label>

        <div class="col-md-12">
          <input id="newPassword" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <div class="col pt-2">
          <input type="checkbox" class="form-check-input" id="showNewPassword"
          onchange="showPass('newPassword', 'showNewPassword')">
        <label class="form-check-label" for="showNewPassword">Lihat Kata Sandi Baru</label>
          </div>  
      </div>
      </div>


      <div class="form-group row mb-0">
        <div class="col-sm-12 pt-4 offset-md-4">
          <button type="submit" class="btn px-3 text-white text-md-right btn-primary">Simpan</button>

        </div>
      </div>
    </div>
    </form>
  
  </div>



@endsection