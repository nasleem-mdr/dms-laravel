@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header">Add new Year</div>
  <div class="card-body">
    <form action="{{ route('year.create')  }}" method="post">
      @csrf
      @include('year.partials.form-control')
    </form>
  </div>

</div>

<div class="card">
  <div class="card-header">
    Table Years
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Year</th>
        <th>Action</th>
      </tr>
      @foreach ($years as $index => $year)
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $year->year }}</td>
        <td>
          <a href="{{ route('year.edit', $year) }}">Edit</a>
          @include('year.delete')
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection