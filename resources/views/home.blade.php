@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">

        <div class="card-body">

        </div>
    </div>
    @endsection