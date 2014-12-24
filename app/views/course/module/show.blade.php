@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
    {{ HTML::style('assets/css/module.css') }}
@stop
@section('js-top')
    {{ HTML::script('assets/js/api.js') }}
    <script>
        base_url = "{{ URL::to('/') }}";
        idUsuarioGlobal = -1;
        nombreUsuarioGlobal = "";
        idCursoGlobal = -1;
        fechaInicioReto = "";
        evaluacionOReto = "";
        rolGlobal = "2";
        idUsuarioGlobal = "2";
        nombreUsuarioGlobal = "Julian Moreno Cadavid";
        idCursoGlobal = "1";
    </script>
@stop
@section('js')
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/hckx7vmz.js"></script>
    {{ HTML::script('assets/js/module.js') }}
@stop
@section('content')
<h1 class="section-title"><span>{{ $module->name }}</span></h1>
<div class="row">
    <div class="col-xs-5">
        <div id="materials-div" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Materiales</h3>
            </div>
            <div class="panel-body">
                <table class="table no-header">
                    @foreach($module->materials as $material)
                        <tr>
                            <td>{{ $material->name }}</td>
                            <td><a class="btn btn-primary video-launcher">Ver</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-7">
        <div id="quizzes-div" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Evaluaciones</h3>
            </div>
            <div class="panel-body">
                <table class="table no-header">
                    @foreach($module->quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->order }}</td>
                            <td><a class="btn btn-primary quiz-launcher">Ver</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div id="iframe-container" class="hide">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <span id="btn-close-iframe" class="pull-right btn-close" data-effect="fadeOut"><i
                        class="fa fa-times"></i></span>
                <h3 id="panel-iframe-title"></h3>
            </div>
            <div class="panel-body">
                <iframe src="http://localhost/quizzes/course_1/module_1/quiz_1/launch.html?version=53"></iframe>
            </div>
        </div>
    </div>
</div>
<div id="video-container" class="hide">
    <div class="container">
        <div id="panel-video" class="panel panel-primary">
            <div class="panel-heading">
            <span id="btn-close-video" class="pull-right btn-close" data-effect="fadeOut"><i
                        class="fa fa-times"></i></span>
                <h3 id="panel-video-title"></h3>
            </div>
            <div class="panel-body">
                <video id="my_video_player" data-autoresize="fit" class="sublime" width="868" height="490" poster="https://cdn.sublimevideo.net/vpa/ms_800.jpg"
                        title="Midnight Sun" data-uid="a240e92d" preload="none">
                    <source src="http://download.wavetlan.com/SVV/Media/HTTP/MP4/ConvertedFiles/Media-Convert/Unsupported/dw11222.mp4"/>
                </video>
            </div>
        </div>
    </div>
</div>
@stop
