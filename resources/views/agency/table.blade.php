@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Tabel Instansi</div>
  <div class="card-body ">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="agencyTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th data-field="nama_unit">Nama Instansi</th>
            <th data-field="alamat">Alamat</th>
            <th data-field="kontak">Kontak</th>
            <th data-sortable="falase">Aksi</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($agencies as $index => $agency)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $agency->name }}</td>
            <td>{{ $agency->address }}</td>
            <td>{{ $agency->contact }}</td>
            <td>
              <a class="btn btn-primary " href="{{ route('agency.detail', $agency) }}">Detail</a>
              <a class="btn btn-primary " href="{{ route('agency.edit', $agency) }}">Edit</a>
              @include('agency.delete', ['agency'
              => $agency])</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection