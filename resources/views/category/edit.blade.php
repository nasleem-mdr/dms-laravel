@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header">Edit {{ $category->category }}</div>
  <div class="card-body">
    <form action="{{ route('category.edit', $category)  }}" method="post">
      @csrf
      @method('PUT')
      @include('category.partials.form-control')
    </form>
  </div>

</div>

@endsection