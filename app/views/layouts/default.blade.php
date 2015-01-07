<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="luismec90@gmail.com">
    <link href="{{ asset('assets/images/general/favicon.png') }}" rel="icon" type="image/x-icon">
    <title>
        @section('title')
            Ticademia
        @show
    </title>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet"
          type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300,700" rel="stylesheet" type="text/css">
    {{ HTML::style('assets/libs/jqueryui/jquery-ui.min.css') }}
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    {{ HTML::style('assets/libs/animate/animate.css') }}
    {{ HTML::style('assets/libs/bootstrap-social/bootstrap-social.css') }}
    {{ HTML::style('assets/css/main.css') }}
    @section('css')
    @show

    @section('js-top')
        @show

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
@include('layouts.partials.header')
<div id="contenedor" class="container-fluid">

    @yield('content')

</div>
@include('layouts.partials.footer')

{{ HTML::script('//code.jquery.com/jquery-2.1.1.min.js') }}
{{ HTML::script('assets/libs/jqueryui/jquery-ui.min.js') }}
{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
{{ HTML::script('assets/libs/bootstrap-growl/bootstrap-growl.min.js') }}
{{ HTML::script('assets/js/main.js') }}

@section('js')
@show
<script>
    load_notification_path = "{{ route('load_notification_path') }}";
    @if(Auth::check() && Auth::user()->unviewedModalNotifications->count())
    $(function () {
        loadNotificaction();
    });
    @endif
</script>
@include('layouts.partials.notify')

<div class="modal fade" id="modal-notification">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Notificación</h4>
            </div>
            <div id="modal-notification-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="loadNotificaction()">
                    Cerrar
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-info-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Carné</h4>
            </div>
            <div id="modal-info-user-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="cover-display">
    <img id="img-loading" src="{{ asset("assets/images/general/loading.gif") }}">
</div>
</body>
</html>