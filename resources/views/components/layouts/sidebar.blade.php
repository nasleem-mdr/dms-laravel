<div>
    @can('create user')
    <div class="mb-4">
        <small class="d-block text-secondary mb-2 text-uppercase ">User</small>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                Create new User
            </a>
            <a href="#" class="list-group-item list-group-item-action">Data Table User</a>
        </div>
    </div>
    @endcan

    @can('create category')
    <div class="mb-5">
        <small class="d-block text-secondary  mb-2 text-uppercase">Cataegory</small>
        <div class="list-group">

            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                Create new Category
            </a>
            <a href="#" class="list-group-item list-group-item-action">Data Table Category</a>
        </div>
    </div>
    @endcan

    @can('assign permission')
    <div class="mb-5">
        <small class="d-block text-secondary  mb-2 text-uppercase">Role & Permission</small>
        <div class="list-group">
            <a href="{{ route('assign.user.create') }}" class="list-group-item list-group-item-action"
                aria-current="true">
                Permission To Users
            </a>
            <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action" aria-current="true">
                Roles
            </a>
            <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action"
                aria-current="true">
                Permission
            </a>
            <a href="{{ route('assign.create') }}" class="list-group-item list-group-item-action" aria-current="true">
                Assign Permission
            </a>
        </div>
    </div>
    @endcan

    @can('create_navigation')
        <div class="mb-5">
        <small class="d-block text-secondary  mb-2 text-uppercase">Navigation Setup</small>
        <div class="list-group">
            <a href="{{ route('navigation.create') }}" class="list-group-item list-group-item-action"
                aria-current="true">
                Create Navigation
            </a>
           
        </div>
    </div>
    @endcan

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