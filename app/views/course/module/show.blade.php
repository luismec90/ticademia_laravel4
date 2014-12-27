@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
    {{ HTML::style('assets/css/module.css') }}
@stop
@section('js-top')
    {{ HTML::script('assets/js/api.js') }}
    <script>
        base_url = "{{ route('course_path',$course->id) }}";
        idCursoGlobal = "1";
        idUsuarioGlobal = "1";
        nombreUsuarioGlobal = "Luis Fernando Montoya";
        rolGlobal = "1";
        fechaInicioReto = "";
        evaluacionOReto = "";
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
                                <td><a class="btn btn-primary video-launcher" data-name="{{ $material->name }}"
                                       data-url="{{ $material->url }}">Ver</a></td>
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
                                <td><a class="btn btn-primary quiz-launcher" data-evaluacion-id="{{ $quiz->id }}"
                                       data-url="{{ $quiz->path($course) }}"
                                       data-order="{{ $quiz->order }}">Ver</a></td>
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
                    <iframe id="iframe_exam"></iframe>
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
                    <video id="my_video_player" class="sublime" data-youtube-id="C1_U79gEPjU" width="868" height="490"
                           preload="none"></video>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-quiz-attempt-feedback">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    				<h4 class="modal-title">Retroalimentación</h4>
    			</div>
    			<div id="modal-body-quiz-attempt-feedback" class="modal-body">
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
