@extends('layouts.default')
@section('css')
{{ HTML::style('assets/css/wall.css') }}
@stop
@section('js')
{{ HTML::script('assets/js/wall.js') }}
<script>
    var wall_path="{{ route('wall_path',$course->id) }}";
</script>
@stop
@section('content')
<h1 class="section-title"><span>{{ $course->subject->name }}: Muro</span> </h1>
<div id="div-comments">
    <div class="row">
        <div class="col-xs-12">
        <div class="well">
           {{ Form::open(['route'=>['wall_save_message_path',$course->id],'class'=>'validate-form','novalidate'=>true]) }}
               <div class="row">
                   <div class="col-xs-12">
                       <textarea name="message" class="form-control message" placeholder="Deja un mensaje..." required="true"></textarea>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-12">
                       <br>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-12">
                       <button class="btn-send-reply btn btn-primary">Publicar</button>
                   </div>
               </div>
           {{ Form::close() }}
           </div>
            <div id="div-append-comments" class="comments-container">
                @include('course.wall.partials.wall_message')
            </div>
            <div id="loadmoreajaxloader" style="display: none;"><img width="50" alt="Loading..." src="{{ asset('assets/images/general/loading2.gif') }}"><div></div></div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-message">
	<div class="modal-dialog">
	    {{ Form::open(['route'=>['wall_delete_message_path',$course->id],'class'=>'validate-form','method'=>'DELETE']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Eliminar publicación</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="wall_message_id" id="message_id">
                    ¿Realmente deseas eliminar esta publicación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div><!-- /.modal-content -->
		{{ Form::close() }}
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop