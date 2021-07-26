@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header">Add new Category</div>
  <div class="card-body">
    <form action="{{ route('category.create')  }}" method="post">
      @csrf
      @include('category.partials.form-control')
    </form>
  </div>

</div>

<div class="card">
  <div class="card-header">
    Table Categories
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Category</th>
        <th>Action</th>
      </tr>
      @foreach ($categories as $index => $category)
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $category->category }}</td>
        <td>
          <a href="{{ route('category.edit', $category) }}">Edit</a>
          @include('category.delete')
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection