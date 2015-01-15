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
    <meta property="og:title" content="Logro: {{ $reachedAchievement->achievement->name }}"/>
    <meta property="og:description" content="Descripción: {{ $reachedAchievement->achievement->description }}"/>
    <meta property="og:image" content="{{ $reachedAchievement->achievement->imagePath(); }}"/>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet"
          type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300,700" rel="stylesheet" type="text/css">
    {{ HTML::style('assets/libs/jqueryui/jquery-ui.min.css') }}
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    {{ HTML::style('assets/libs/animate/animate.css') }}
    {{ HTML::style('assets/libs/bootstrap-social/bootstrap-social.css') }}
    {{ HTML::style('assets/css/main.css') }}


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

    <div class="row">
        <div class="col-lg-2 col-sm-3">
            @include('layouts.partials.avatar_square',['user'=>$reachedAchievement->user,'size'=>'100%'])
        </div>

        <div class="col-lg-8 col-sm-6">
            <div class="row">
                <div class="col-xs-12">

                    <h2> {{ $reachedAchievement->user->fullName() }} ha ganado el siguiente logro en el curso: {{ $reachedAchievement->course->subject->name }}</h2>
                    <h3>Logro: {{ $reachedAchievement->achievement->name }}</h3>
                    <h4>
                        {{ $reachedAchievement->achievement->description }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-3">
            @include('course.partials.achievement_image',['achievement'=>$reachedAchievement->achievement,'size'=>'100%'])
        </div>
    </div>

</div>
@include('layouts.partials.footer')

{{ HTML::script('//code.jquery.com/jquery-2.1.1.min.js') }}
{{ HTML::script('assets/libs/jqueryui/jquery-ui.min.js') }}
{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
{{ HTML::script('assets/libs/bootstrap-growl/bootstrap-growl.min.js') }}
{{ HTML::script('assets/js/main.js') }}


</body>
</html>