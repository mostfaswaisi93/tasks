<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown user-menu user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{url('/')}}/design/adminlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i> Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> <span>
                            Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
