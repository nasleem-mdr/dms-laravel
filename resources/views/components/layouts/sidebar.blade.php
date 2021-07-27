<div>
    @can('edit profile')
    <div class="mb-4">
        <small class="d-block text-secondary mb-2 text-uppercase ">Profile</small>
        <div class="list-group">
            {{--  
                    link lihat halaman profile  : {{ route('profile.show')}} --}}
            <a href="{{ route('profile.show')}}" class="list-group-item list-group-item-action " aria-current="true">
                {{ auth()->user()->employee->name }}
            </a>

            {{-- link untuk ubah password masing-masing user  --}}
            <a href="{{ route('profile.reset_password')}}" class="list-group-item list-group-item-action "
                aria-current="true">
                Ubah Password
            </a>

            {{-- link untuk edit profile  --}}
            <a href="{{ route('profile.edit')}}" class="list-group-item list-group-item-action " aria-current="true">
                Edit Profile
            </a>

        </div>
    </div>
    @endcan

    @foreach ($navigations as $navigation)
    @can($navigation->permission_name)
    <div class="mb-4">
        <small class="d-block text-secondary mb-2 text-uppercase ">{{ $navigation->name }}</small>
        <div class="list-group">
            @foreach ($navigation->children as $child)
            <a href="{{ ($child->url===null) ? '#' : url($child->url )}}"
                class="list-group-item list-group-item-action " aria-current="true">
                {{ $child->name }}
            </a>
            @endforeach

        </div>
    </div>
    @endcan
    @endforeach

    <div class="mb-5">
        <small class="d-block text-secondary  mb-2 text-uppercase">Logout</small>
        <div class="list-group">

            <a class="list-group-item list-group-item-action" aria-current="true" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

</div>