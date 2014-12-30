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
        load_material_reviews_path = "{{ route('load_material_reviews_path',[$course->id,$module->id]) }}"
    </script>
@stop
@section('js')
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/hckx7vmz.js"></script>
    {{ HTML::script('assets/js/module.js') }}
@stop
@section('content')

    <h1 class="section-title"><span><a class="btn btn-default btn-back" title="Ir atrás"
                                       href="{{ route('course_path',$course->id) }}"><i
                        class="fa fa-reply"></i></a>{{ $module->name }}</span></h1>

    <div class="row">
        <div class="col-md-6">
            <div id="materials-div" class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Materiales</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <tr>
                            <td>
                                Material
                            </td>
                            <td>
                                Duración
                            </td>

                            <td>
                                Comentarios
                            </td>
                            <td>
                                Opciones
                            </td>
                        </tr>
                        @foreach($module->materials as $material)
                            <tr>
                                <td>{{ $material->name }}</td>
                                <td>{{ round($material->duration/60,1) }} m</td>
                                {{--<td>
                                     @foreach($material->reviews as $review)
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @for ($i=1; $i <= 5 ; $i++)
                                                    <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                                                @endfor

                                                {{ $review->user ? $review->user->name : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span>

                                                <p>{{{$review->comment}}}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </td>--}}
                                <td>
                                    Valoración: {{ $material->rating_cache }} <a class="link create-review"
                                                                                 data-name="{{ $material->name }}"
                                                                                 data-material-id="{{ $material->id }}">Valorar</a><br>
                                    <hr>
                                    Comentarios: {{ $material->rating_count }}
                                    <br>
                                    <a class="link show-reviews" data-name="{{ $material->name }}"
                                       data-material-id="{{ $material->id }}">Ver comentarios</a>
                                </td>
                                <td><a class="btn btn-default btn-sm btn-primary video-launcher"
                                       data-name="{{ $material->name }}"
                                       data-url="{{ $material->url }}">Repdoducir</a>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="quizzes-div" class="panel panel-primary">
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
                    <video id="my_video_player" class="sublime" data-youtube-id="Dv7gLpW91DM" data-autoresize="fit"
                           width="868" height="490"
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
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modal-create-review">
        <div class="modal-dialog">
            {{ Form::open(['route'=>['store_material_review_path',$course->id,$module->id],'class'=>'validate-form','novalidate'=>true]) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Material: <span id="material-name"></span></h4>
                </div>
                <div class="modal-body">
                    {{ Form::hidden('material_id',null,['id'=>'material_id','required'=>'required']) }}
                    <!--  Form Input -->
                    <div class="form-group">
                        {{ Form::label('rating','Puntaje:') }}
                        {{ Form::select('rating',[''=>'Seleccionar...','1','2','3','4','5','6','7','8','9','10'],null,['class'=>'form-control','required'=>'required']) }}
                    </div>

                    <!--  Form Input -->
                    <div class="form-group">
                        {{ Form::label('comment','Comentario:') }}
                        {{ Form::textarea('comment',null,['class'=>'form-control']) }}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            <!-- /.modal-content -->
            {{ Form::close() }}
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modal-show-reviews">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Material: <span id="modal-show-reviews-material-name"></span></h4>
                </div>
                <div id="body-modal-show-reviews" class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
