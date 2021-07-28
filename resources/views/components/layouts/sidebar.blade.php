<a id="show-sidebar" class="btn btn-sm sidebar_button" href=" #">
  <i class="fas fa-bars"></i>
</a>

<nav id="sidebar" class="sidebar-wrapper">
  <div class="sidebar-content">
    <div class="sidebar-brand">
      <a class="text-center text-white" href="{{ route('home') }}">DMS</a>
      <div id="close-sidebar">
        <i class="fas fa-times"></i>
      </div>
    </div>
    <div class="sidebar-header">
      <div class="user-pic">
        <img class="img-responsive img-rounded"
          src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
          alt="User picture">
      </div>
      <div class="user-info">
        <span class="user-name">
          <a class="text-white"
            href="{{ route('profile.show')}}"><strong>{{ auth()->user()->employee->name }}</strong></a>
        </span>
        <span class="user-role">{{ auth()->user()->employee->position->position }}</span>
        <span class="user-role"><a class="text-white" href="{{ route('profile.show')}}">My Profile</a></span>
      </div>
    </div>
    <!-- sidebar-header  -->

    <div class="sidebar-menu mb-0">
      <ul>
        <li>
          <a href="{{ route('dashboard')}}">
            <span class="text-white">Dashboard</span>
          </a>
        </li>
      </ul>
    </div>

    <div class=" sidebar-menu">
      <ul>
        @foreach ($navigations as $navigation)
        @can($navigation->permission_name)
        <li class="sidebar-dropdown">
          <a href="#">
            <span class="text-white">{{ $navigation->name }}</span>
            <span class=" badge badge-pill badge-warning"></span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @foreach ($navigation->children as $child)
              <li>
                <a class="text-white" href="{{ ($child->url === null) ? '#' : url($child->url) }}">{{ $child->name }}
                  <span class="badge badge-pill badge-success"></span>
                </a>
              </li>
              @endforeach
            </ul>


          </div>
          @endcan
          @endforeach
        </li>

      </ul>
    </div>
    <!-- sidebar-menu  -->
  </div>
  <!-- sidebar-content  -->
  <div class="sidebar-footer">
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
      <i class="fa fa-power-off"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>
</nav>
<!-- sidebar-wrapper  -->

<!-- page-content" -->