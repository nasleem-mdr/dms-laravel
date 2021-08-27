@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Data Tabel Navigasi</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="agencyTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th data-field="parent">Parent</th>
            <th data-field="nama">Nama</th>
            <th data-field="url">URL</th>
            <th data-sortable="falase">Aksi</th>
          </tr>
        </thead>
        <tbody>  

      @foreach ($navigations as $navigation)
      <tr>
        <td>{{ $navigation->parent->name }}</td>
        <td>{{ $navigation->name }}</td>
        <td>{{ $navigation->url }}</td>
        <td>{{ $navigation->permission_name }}</td>
        <td><a class="btn btn-primary btn-block" href="{{ route('navigation.edit', $navigation) }}">Edit</a>
          @include('navigation.delete', ['navigation'
          => $navigation])</td>
      </tr>
      @endforeach
      
        </tbody>
    </table>
    </div>
    
  </div>
</div>
@endsection