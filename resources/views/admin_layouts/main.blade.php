@include('admin_layouts.header')

<div class="foorbis-section">
    <!-- foorbis-sidebar -->
    @include('admin_layouts.sidebar')
    <!-- foorbis-sidebar-end -->
    @yield('content')
</div>
@include('admin_layouts.footer')
