@extends('layouts.back')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard') }}">
@endsection

@section('content')
<ol class="breadcrumb d-flex mt-4">
  <li class="breadcrumb-item active">{{ ucwords(explode('.', Route::currentRouteName())[0]) }}</li>
</ol>

<div class="row">
  <div class="{{ auth()->user()->hasRole('admin') ? 'col-md-12' : 'col-xl-4 col-md-6' }}">
    <div class="card mb-4 d-flex">
      <div class="card-body card__body-title">
        <div class="d-flex flex-column">
          <p>Selamat Datang,</p>
          <span class="h5 bold text__blue-color pt-1 pb-2">{{ auth()->user()->employee->name }}</span>
        </div>
        {{-- <img src="" class="card__body-icon pt-1" alt="Welcome Icon"> --}}
      </div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class=" text__blue-color stretched-link h6" href="#">Lihat
          Petunjuk</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>

  @if (auth()->user()->hasRole('super admin'))
  <div class="col-xl-4 col-md-6">
    <div class="card text__black bg-white  mb-4">
      <div class="card-body bg- card__body-title h6">Jumlah Instansi</div>
      <div class="card-body pt-0 h3 " id="total_agencies">
        0
      </div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class=" text__blue-color stretched-link h6" href="{{ route('agency.table')}}">Lihat
          Detail</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card text__black mb-4">
      <div class="card-body card__body-title h6">Jumlah Pegawai</div>
      <div class="card-body pt-0 h3" id="total_employee">
        0
      </div>
      {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
      alt="Welcome Icon"> --}}
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="text__blue-color stretched-link h6" href="{{ route('employee.table')}}">Lihat
          Detail</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class='bx bx-bar-chart-alt-2 mr-2'></i>
          Jumlah Arsip Kepegawaian di setiap instansi
        </div>
        <div class="card-body">
          <canvas id="archiveChart" width="100%" height="40"></canvas>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class='bx bx-pie-chart-alt-2 mr-2'></i>
          Jumlah Dokumen di setiap instansi
        </div>
        <div class="card-body">
          <canvas id="documentChart" width="100%" height="40">
          </canvas></div>
      </div>
    </div>

  </div>
</div>
@endif

@if (auth()->user()->hasRole('admin'))
</div>

<div class="row">
  <div class="col-xl-4 col-md-6">
    <div class="card text__black mb-4">
      <div class="card-body card__body-title h6">Jumlah Pegawai</div>
      <div class="card-body pt-0 h3" id="total_employee">
        0
      </div>
      {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
      alt="Welcome Icon"> --}}
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="text__blue-color stretched-link h6" href="{{ route('employee.table')}}">Lihat
          Detail</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>


  <div class="col-xl-4 col-md-6">
    <div class="card text__black mb-4">
      <div class="card-body card__body-title h6">Jumlah Arsip Kepegawaian</div>
      <div class="card-body pt-0 h3" id="total_archive">
        0
      </div>
      {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
      alt="Welcome Icon"> --}}
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="text__blue-color stretched-link h6" href="{{ route('archive.table')}}">Lihat
          Detail</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card text__black mb-4">
      <div class="card-body card__body-title h6">Jumlah Dokumen</div>
      <div class="card-body pt-0 h3" id="total_document">
        0
      </div>
      {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
      alt="Welcome Icon"> --}}
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="text__blue-color stretched-link h6" href="{{ route('document.table')}}">Lihat
          Detail</a>
        <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
      </div>
    </div>
  </div>

</div>

@endif

@if (auth()->user()->hasRole('pegawai'))

<div class="col-xl-4 col-md-6">
  <div class="card text__black mb-4">
    <div class="card-body card__body-title h6">Jumlah Arsip Kepegawaian</div>
    <div class="card-body pt-0 h3" id="total_archive">
      0
    </div>
    {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
    alt="Welcome Icon"> --}}
    <div class="card-footer d-flex align-items-center justify-content-between">
      <a class="text__blue-color stretched-link h6" href="{{ route('archive.table')}}">Lihat
        Detail</a>
      <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
    </div>
  </div>
</div>

<div class="col-xl-4 col-md-6">
  <div class="card text__black mb-4">
    <div class="card-body card__body-title h6">Jumlah Dokumen</div>
    <div class="card-body pt-0 h3" id="total_document">
      0
    </div>
    {{-- <img src="{{asset('icons/trophy_card_icon.svg')}}" width="60px" height="60px" class="card__body-icon mt-4"
    alt="Welcome Icon"> --}}
    <div class="card-footer d-flex align-items-center justify-content-between">
      <a class="text__blue-color stretched-link h6" href="{{ route('document.table')}}">Lihat
        Detail</a>
      <div class="text__blue-color"><i class='bx bx-chevron-right bx-sm'></i></div>
    </div>
  </div>
</div>

</div>

@endif

@endsection

@push('scripts')

@if (auth()->user()->hasRole('super admin'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/dashboard/super_admin/charts.js') }}"></script>
@endif

@if (auth()->user()->hasRole('admin'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/dashboard/admin/charts.js') }}"></script>
@endif

@if (auth()->user()->hasRole('pegawai'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/dashboard/employee/charts.js') }}"></script>
@endif

@endpush