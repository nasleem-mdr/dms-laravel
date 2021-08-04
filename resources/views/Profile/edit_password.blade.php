@extends('layouts.back')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')



@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Ubah Password</div>
  <div class="card-body">
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

      <div class="form-group row">
        <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Kata Sandi Lama</label>

        <div class="col-md-6">
          <input id="oldPassword" type="password" class="form-control @error('old_password') is-invalid @enderror"
            name="old_password" required autocomplete="current-old_password">

          @error('old_password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="showOldPassword"
          onchange="showPass('oldPassword', 'showOldPassword')">
        <label class="form-check-label" for="showOldPassword">Lihat Kata Sandi Lama</label>
      </div>

      <div class="form-group row">
        <label for="newPassword" class="col-md-4 col-form-label text-md-right">Kata Sandi Baru</label>

        <div class="col-md-6">
          <input id="newPassword" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="showNewPassword"
          onchange="showPass('newPassword', 'showNewPassword')">
        <label class="form-check-label col-md-4" for="showNewPassword">Lihat Kata Sandi Baru</label>
      </div>


      <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
          <button type="submit" class="btn btn-primary">Simpan</button>

        </div>
      </div>

    </form>
  </div>
</div>
@endsection