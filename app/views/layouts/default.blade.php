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

        {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
        {{ HTML::style('assets/libs/jqueryui/jquery-ui.min.css') }}
        {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') }}
        {{ HTML::style('assets/libs/animate/animate.css') }}
        {{ HTML::style('assets/css/main.css') }}
        @section('css')
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

         @include('layouts.partials.notify')
         <div id="cover-display">
             <img id="img-loading" src="{{ asset("assets/images/general/loading.gif") }}" >
         </div>
    </body>
</html>