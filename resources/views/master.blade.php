@include('admin.layouts.header')
@include('admin.layouts.navbar')

<div class="content-wrapper">
  <section class="content">
    @include('admin.layouts.message')
    @yield('content')
  </section>
</div>

@include('admin.layouts.footer')