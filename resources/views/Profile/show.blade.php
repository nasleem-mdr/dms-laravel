@extends('layouts.back')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if (session('error_message'))
<div class="alert alert-danger">
  {{ session('success') }}
</div>
@endif

<div class="row mt-4">
  <div class="col-md-4 mb-3 ">
    <div class="card">
      <div class="card-body pb-4">
        <div class="d-flex flex-column align-items-center text-center">

          <div class="img__wrap">
            <a href="{{ route('profile.profile_picture', $employee) }}">
              <img class="img_responsive img-rounded img__img " style="max-height: 220px;"
                src="{{ ($employee->profile_picture === 'default-profile.png') ? asset('/images/profile/default-profile.png') :  asset('/images/profile/employees/' . $employee->agency->name . '/' . $employee->profile_picture)  }}"
                alt="{{ $employee->profile_picture}}" width="220" />
              <div class="img__description_layer">
                <p class="img__description ">Ganti Foto</p>
              </div>
            </a>

          </div>

          <div class="mt-3">
            <h4>{{ $employee->name }}</h4>
            <p class="text-secondary mb-1">{{ $employee->position->position }}, {{ $employee->agency->name }}</p>
            <p class="text-muted font-size-sm">{{ $employee->address }}</p>
            <a href="{{ route('profile.reset_password') }}" class="btn btn-outline-info mt-lg-2">Ubah
              Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card mb-3">
      <div class="card-header">Identitas Lengkap</div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">NIP</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            {{ $employee->nip }}
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Nama Lengkap</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            {{ $employee->name }}
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            {{ $employee->user->email }}
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">No. Handphone</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            {{ $employee->phone_number }}
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Alamat</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            {{ $employee->address }}
          </div>
        </div>
        <hr>
        <div class="row ">
          <div class="col-sm-12 ">
            <a href="{{ route('profile.edit')  }}" class="btn btn-outline-info float-right">Ubah Data Identitas</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection