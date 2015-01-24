@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/libs/slider-pips/css/jquery-ui-slider-pips.css') }}
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
        load_material_reviews_path = "{{ route('load_material_reviews_path',[$course->id,$module->id]) }}";
        material_video_playbacktime_path = "{{ route('material_video_playbacktime_path',[$course->id,$module->id]) }}";
        module_path = "{{ route('module_path',[$course->id,$module->id]) }}";
        raty_path = "{{ asset('assets/libs/raty/') }}";
        courseJSON = JSON.parse('{{ json_encode($course) }}');
        current_module="{{ $module->id }}";
    </script>
@stop
@section('js')
    {{ HTML::script('assets/libs/slider-pips/js/jquery-ui-slider-pips.js') }}
    {{ HTML::script('assets/libs/raty/jquery.raty.js') }}
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/hckx7vmz.js"></script>
    {{ HTML::script('assets/js/module.js') }}
    <script>
        info_user_path = "{{ route('info_user_path',$course->id) }}";
    </script>
@stop
@section('content')
    <h1 class="section-title"><span>
            {{--<a class="btn btn-default btn-back" title="Ir atrás"
                                       href="{{ route('course_path',$course->id) }}"><i
                        class="fa fa-reply"></i></a>--}} {{ $module->name }}</span></h1>
    <h4 class="text-center">{{ $module->start_date  }} / {{ $module->end_date }}</h4>
    <br>
    @if(Auth::user()->isTeacher($course->id))
        <div class="row">
            <div class="col-xs-12">
                <a class="btn btn-primary" data-toggle="modal" href="#modal-create-material">Crear material</a>
                <a class="btn btn-primary pull-right" data-toggle="modal" href="#modal-create-quiz">Crear evaluación</a>
            </div>
        </div>
        <br>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div id="modules-slider"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    <div id="body-module">
        @include('course.module.partials.main')
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
                <div id="panel-body-video" class="panel-body">
                    <video id="my_video_player" class="sublime" data-youtube-id="Dv7gLpW91DM"
                           data-settings="uid:demo-responsive-fit-resizing; autoresize:fit;"

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
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="loadNotificaction()">
                        Cerrar
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-create-review">
        <div class="modal-dialog">
            {{ Form::open(['route'=>['store_material_review_path',$course->id,$module->id],'method'=>'PUT','class'=>'validate-form','novalidate'=>true]) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Material: <span id="material-name"></span>

                        <div id="preview-stars"></div>
                    </h4>
                </div>
                <div class="modal-body">
                    {{ Form::hidden('material_id',null,['id'=>'material-id','required'=>'required']) }}
                    {{ Form::hidden('review_id',null,['id'=>'create-review-id']) }}

                    <!--  Form Input -->
                    <div class="form-group">
                        {{ Form::label('comment','Comentario:') }}
                        {{ Form::textarea('comment',null,['id'=>'create-review-comment','class'=>'form-control']) }}
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
    </div>
    <!-- /.modal -->

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
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-skip-quiz">
        <div class="modal-dialog">
            {{ Form::open(['route'=>['skip_quiz_path',$course->id,$module->id],'class'=>'validate-form','novalidate'=>true]) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Saltar evaluación</h4>
                </div>
                <div class="modal-body">
                    {{ Form::hidden('quiz_id',null,['id'=>'skip-quiz-id','required'=>'required']) }}
                    ¿Deseas saltar esta evaluación? ten en cuenta que luego la podrás realizar pero ya no recibirás
                    puntuación.
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
    </div>
    <!-- /.modal -->

    @if(Auth::user()->isTeacher($course->id))
        @include('course.module.partials.CRUD_materials_quizzes')
    @endif
@stop
