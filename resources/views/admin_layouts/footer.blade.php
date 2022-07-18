</section>
</body>
<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('js/foorbis-custom.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<!-- foorbis-sidebar-menu-bar -->
<script type="text/javascript">
$('.responive-left-menu').click(function() {
    $(".foorbis-sidebar").addClas
    s("foorbis-sidebar-open");
});

$('.foorbis-sidebar-close').click(function() {
    $(".foorbis-sidebar").removeClass("foorbis-sidebar-open");
});
</script>
@stack('scripts')

</html>