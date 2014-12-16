<script>
@if (Session::has('flash_notification.message'))
$(document).ready(function () {
    $.growl("{{ Session::get('flash_notification.message') }}", {
        type: "{{ Session::get('flash_notification.level') }}",
        animate: {
            enter: 'animated zoomInDown',
            exit: 'animated zoomOut'
        },
        placement: {
            from: "top",
            align: "center"
        }
    });
});
@endif
</script>