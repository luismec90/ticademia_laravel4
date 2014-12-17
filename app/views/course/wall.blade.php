@extends('layouts.default')
@section('css')
{{ HTML::style('assets/css/wall.css') }}
@stop
@section('js')
{{ HTML::script('assets/js/wall.js') }}
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
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    @foreach($course->wallMessages as $wallMessage)
                    <li>
                        <div class="comment-main-level">
                            <!-- Avatar -->
                            <div class="comment-avatar"><img src="{{ $wallMessage->user->avatarPath() }}" alt=""></div>
                            <!-- Contenedor del Comentario -->
                            <div class="comment-box">
                                <div class="comment-head">
                                    <h6 class="comment-name">{{ $wallMessage->user->fullName() }}</h6>
                                    <span>{{ $wallMessage->created_at->diffForHumans() }}</span>
                                    <i class="reply fa fa-reply"></i>
                                </div>
                                <div class="comment-content">
                                    {{{ $wallMessage->message }}}
                                </div>
                            </div>
                        </div>
                        <!-- Respuestas de los comentarios -->
                        <ul class="comments-list reply-list">
                            @foreach($wallMessage->replies as $reply)
                            <li>
                                <!-- Avatar -->
                                <div class="comment-avatar"><img src="{{ $reply->user->avatarPath() }}" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name">{{ $reply->user->fullName() }}</h6>
                                         <span> {{  $reply->created_at }} | {{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="comment-content">
                                        {{{ $reply->message }}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="div-reply hide">
                                <!-- Avatar -->
                                <div class="comment-avatar"><img src="{{ Auth::user()->avatarPath() }}" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name">{{ Auth::user()->fullName() }}</h6>
                                    </div>
                                    <div class="comment-content">
                                        {{ Form::open(['route'=>['wall_save_reply_path',$course->id,$wallMessage->id],'class'=>'validate-form','novalidate'=>true]) }}
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <textarea name="message" class="form-control message" placeholder="Deja tu mensaje..." required="true"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button class="btn-cancel-reply btn btn-danger btn-sm">Cancelar</button>
                                                    <button class="btn-send-reply btn btn-primary btn-sm">Publicar</button>
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop