<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            DMS - Document Management System
        </a>
        @guest
        @if (Route::has('login'))
        @endif

        @if (Route::has('register'))
        @endif
        @else

        @hasanyrole($roles)
        @endhasanyrole
        
        
        @endguest
    </div>
</nav>