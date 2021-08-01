@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">
    <div class="col justify-content-md-around">
      Arsip Kepegawaian
      @if ($user->hasRole(['admin', 'pegawai']))
      {{ $archives[1]->agency->name }}
      @endif
      <a class="btn btn-sm btn-primary float-right" href="{{ route('archive.create') }}">Tambah Arsip Kepegawaian</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="archiveTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th data-field="nip">NIP</th>
            <th data-field="no_arsip">No. Arsip</th>
            <th data-field="tahun">Tahun</th>
            <th data-field="deskripsi">Deskripsi</th>
            @if ($user->hasRole('super admin'))
            <th data-field="instansi">Instansi</th>
            @endif
            <th data-sortable="falase">Aksi</th>
          </tr>
        </thead>
        <tbody>

        @foreach ($archives as $index => $archive)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $archive->employee->nip}}</td>
          <td>{{ $archive->no }}</td>
          <td>{{ $archive->year->year }}</td>
          <td>{{ $archive->desc }}</td>
          @if ($user->hasRole('super admin'))
          <td>{{ $archive->employee->agency->name }}</td>
          @endif
          <td>
            <a class="text-primary" href="{{ route('archive.edit', $archive) }}">Edit</a>
            @include('archive.delete', ['archive'=> $archive])
          </td>

        </tr>
        @endforeach

          </tbody>
        </table>
      </div>
      
    </div>
  </div>
  @endsection