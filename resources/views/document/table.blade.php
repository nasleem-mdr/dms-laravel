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
      Arsip Dinamis
      @if ($user->hasRole(['admin', 'pegawai']))
      {{ $user->employee->agency->name }}
      @endif
      <a class="btn btn-sm btn-primary float-right" href="{{ route('document.create') }}">Tambah Arsip Dokumen</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="documentTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            @if ($user->hasRole('super admin'))
            <th data-field="nama_unit">Instansi</th>
            @endif
            <th data-field="nip">NIP</th>
            <th data-field="no_arsip">No. Arsip</th>
            <th data-field="tahun">Tahun</th>
            <th data-field="kategori">Kategori</th>
            <th data-field="deskripsi">Deskripsi</th>
            <th data-field="file">File</th>
            <th data-sortable="falase">Aksi</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($documents as $index => $document)
          <tr>
            <td>{{ $index + 1 }}</td>
            @if ($user->hasRole('super admin'))
            <td>
              {{ isset($document->employee->agency->name) ? $document->employee->agency->name : $document->agency->name }}
            </td>
            @endif
            <td>{{ isset($document->employee->nip) ? $document->employee->nip : $user->username }}</td>
            <td>{{ $document->no }}</td>
            <td>{{ $document->year->year }}</td>
            <td>{{ $document->document_category->category }}</td>
            <td>{{ $document->desc }}</td>
            <td><a href="{{ route('document.download', $document) }}">{{ $document->file }}</a></td>
            <td>
              <a class="text-primary" href="{{ route('document.edit', $document) }}">Edit</a>
              @include('document.delete', ['document'=> $document])
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection