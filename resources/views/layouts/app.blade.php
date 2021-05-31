@extends('layouts.base')

@section('body')

<main class="py-4">
    <x-layouts.navigation></x-layouts.navigation>
    @yield('content')
</main>

@endsection