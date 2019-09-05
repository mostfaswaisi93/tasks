@include('admin.layouts.header')
@include('admin.layouts.navbar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            @include('admin.layouts.message')
            @yield('content')
    </section>
  </div>

@include('admin.layouts.footer')
