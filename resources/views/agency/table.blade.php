@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Data Table Agency</div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Action</th>
      </tr>

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

    </table>
  </div>
</div>
@endsection