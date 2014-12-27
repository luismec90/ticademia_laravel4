@extends('layouts.default')
@section('css')
{{ HTML::style('assets/css/forum.css') }}
{{ HTML::style('assets/libs/datatables/css/dataTables.bootstrap.css') }}
@stop
@section('js')
    {{ HTML::script('assets/js/forum.js') }}
    {{ HTML::script('assets/libs/datatables/js/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/libs/datatables/js/dataTables.bootstrap.js') }}
    <script>
        $(document).ready(function () {
            $('#table-comments').dataTable({
                "language": {
                    "url": "{{ asset('assets/libs/datatables/js/spanish.lang') }}"
                },
                "bSort": false
            });
        });
    </script>
@stop
@section('content')
<h1 class="section-title"><span>{{ $course->subject->name }}: Foro</span> </h1>
<div id="div-forum">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b class="link">{{ $topic->name }}</b></div>
                        <div class="panel-body">
                            <div class="col-xs-3 col-sm-2 col-md-1">
                                @include('layouts.partials.avatar_square',['user'=>$topic->user])
                            </div>
                            <div class="col-xs-9 col-sm-10 col-md-11 ">
                                <div class="row info-date">
                                    <div class="col-xs-12">
                                        <div class="text-muted">Publicado <b>{{ $topic->created_at->diffForHumans() }}</b>: {{ $topic->created_at }}, por <b>{{ $topic->user->fullName() }}</b></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        {{{ $topic->description }}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
             <div class="well">
                       {{ Form::open(['route'=>['topic_save_reply_path',$course->id,$topic->id],'class'=>'validate-form','novalidate'=>true]) }}
                           <div class="row">
                               <div class="col-xs-12">
                                   <textarea name="message" class="form-control message" placeholder="Deja un mensaje..." required="true" rows="5"></textarea>
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

            <table id="table-comments" class="table">
                <thead>
                    <tr>
                        <td></td>
                        <td>Mensaje</td>
                    </tr>
                </thead>
                @foreach($topicReplies as $topicReply)
                <tr>
                    <td class="col-xs-3 col-sm-2 col-md-1">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                @include('layouts.partials.avatar_square',['user'=>$topicReply ->user])
                            </div>
                        </div>
                    <td  class="container-reply">
                        <div class="row info-date">
                            <div class="col-xs-12">
                                                            @if($topicReply->user->isMe())
                                                                                                                   <i class="delete-topic-reply fa fa-trash pull-right" data-topic-reply-id="{{ $topicReply->id }}"></i>
                                                                                                                <i class="edit-topic-reply fa fa-pencil-square-o pull-right" data-topic-reply-id="{{ $topicReply->id }}" data-message="{{ $topicReply->reply }}"></i>
                                                                                                                @endif
                                <div class="text-muted">Publicado <b>{{ $topicReply->created_at->diffForHumans() }}</b>: {{ $topicReply->created_at }}, por <b>{{ $topicReply->user->fullName() }}</b>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                {{{ $topicReply->reply }}}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-topic-reply">
	<div class="modal-dialog">
	    {{ Form::open(['route'=>['topic_edit_reply_path',$course->id,$topic->id],'class'=>'validate-form','method'=>'PUT']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar mensaje</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="topic_reply_id" id="edit_topic_reply_id">
                    <textarea id="textarea_edit_topic_reply" name="message" class="form-control" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div><!-- /.modal-content -->
		{{ Form::close() }}
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-delete-topic-reply">
	<div class="modal-dialog">
	    {{ Form::open(['route'=>['topic_delete_reply_path',$course->id,$topic->id],'class'=>'validate-form','method'=>'DELETE']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Eliminar mensaje</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="topic_reply_id" id="topic_reply_id">
                    ¿Realmente deseas eliminar este mensaje?
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