@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
@stop

@section('js')
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/hckx7vmz.js"></script>
@stop

@section('content')
    <h1 class="section-title"><span>{{ $module->name }}</span></h1>
    <div class="row">
        <div class="col-xs-4">
            <table class="table">
                <tr>
                    <td>Material</td>
                    <td>Opciones</td>
                </tr>
                @foreach($module->materials as $material)
                    <tr>
                        <td>{{ $material->name }}</td>
                        <td><a class="btn btn-primary">Ver</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-xs-2">
        </div>
        <div class="col-xs-5">
            <table class="table">
                <tr>
                    <td>Evaluación</td>
                    <td>Opciones</td>
                </tr>
                @foreach($module->quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->order }}</td>
                        <td><a class="btn btn-primary">Ver</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
{{--
            <video id="a240e92d" class="sublime" poster="https://cdn.sublimevideo.net/vpa/ms_800.jpg" width="640" height="360" title="Midnight Sun" data-uid="a240e92d" preload="none">
            <source src="https://pdlvimeocdn-a.akamaihd.net/38501/737/319448679.mp4?token2=1419282642_63d35c574817ebe3f51a4848b9da9194&aksessionid=56519e9e1b8f62d1" />
            </video> --}}