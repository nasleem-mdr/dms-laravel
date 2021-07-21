@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Data Table Navigation</div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>Parent</th>
        <th>Name</th>
        <th>URL</th>
        <th>Permission Name</th>
        <th>Action</th>
      </tr>

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

    </table>
  </div>
</div>
@endsection