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
      Arsip Dinamis
      <a class="btn btn-sm btn-primary float-right" href="{{ route('document.create') }}">Tambah Arsip Kepegawaian</a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        @if ($user->hasRole('super admin'))
        <th>Instansi</th>
        @endif
        <th>NIP</th>
        <th>No. Arsip</th>
        <th>Tahun</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>File</th>
        @if ($user->hasRole('super admin'))
        <th>
          Role
        </th>
        @endif
        <th>Action</th>

      </tr>

      @foreach ($documents as $index => $document)
      <tr>
        <td>{{ $index + 1 }}</td>
        @if ($user->hasRole('super admin'))
        <td>{{ $document->employee->agency->name }}</td>
        @endif
        <td>{{ $document->employee->nip}}</td>
        <td>{{ $document->no }}</td>
        <td>{{ $document->year->year }}</td>
        <td>{{ $document->document_category->category }}</td>
        <td>{{ $document->desc }}</td>
        <td><a href="{{ route('document.download', $document) }}">{{ $document->file }}</a></td>
        @if ($user->hasRole('super admin'))
        <td>
          {{ implode(', ', $document->employee->user->getRoleNames()->toArray()) }}
        </td>
        @endif
        <td>
          <a class="text-primary" href="{{ route('document.edit', $document) }}">Edit</a>
          @include('document.delete', ['document'=> $document])
        </td>

      </tr>
      @endforeach

    </table>
  </div>
</div>
@endsection