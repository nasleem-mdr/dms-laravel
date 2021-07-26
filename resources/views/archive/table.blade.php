@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card">
  <div class="card-header">
    <div class="col justify-content-md-around">
      Arsip Kepegawaian
      <a class="btn btn-sm btn-primary float-right" href="{{ route('archive.create') }}">Tambah Arsip Kepegawaian</a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>NIP</th>
        <th>No. Arsip</th>
        <th>Tahun</th>
        <th>Deskripsi</th>
        <th>Instansi</th>
        @if ($user->hasRole('super admin'))
        <th>
          Role
        </th>
        @endif
        <th>Action</th>

      </tr>

      @foreach ($archives as $index => $archive)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $archive->employee->nip}}</td>
        <td>{{ $archive->no }}</td>
        <td>{{ $archive->year->year }}</td>
        <td>{{ $archive->desc }}</td>
        <td>{{ $archive->employee->agency->name }}</td>
        @if ($user->hasRole('super admin'))
        <td>
          {{ implode(', ', $archive->employee->user->getRoleNames()->toArray()) }}
        </td>
        @endif
        <td>
          <a class="text-primary" href="{{ route('archive.edit', $archive) }}">Edit</a>
          @include('archive.delete', ['archive'=> $archive])
        </td>

      </tr>
      @endforeach

    </table>
  </div>
</div>
@endsection