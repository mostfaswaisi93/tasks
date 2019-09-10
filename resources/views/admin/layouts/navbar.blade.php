<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Tasks</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @include('admin.layouts.menu')
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{-- <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/')}}/design/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </div> --}}
        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <li><a href="/admin/tasks"><i class="fa fa-tasks" aria-hidden="true"></i>
                    <span> Tasks</span></a></li>
            <li><a href="/admin/employees"><i class="fa fa-users" aria-hidden="true"></i>
                    <span> Employees</span></a></li>
            <li><a href="/admin/projects"><i class="fas fa-project-diagram"></i>
                    <span> Projects</span></a></li>
            <li><a href="/admin/departments"><i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span> Departments</span></a></li>
            <li><a href="/admin/skills"><i class="fa fa-file" aria-hidden="true"></i>
                    <span> Skills</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>