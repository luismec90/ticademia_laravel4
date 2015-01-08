<ul id="comments-list" class="comments-list">
    @foreach($wallMessages as $wallMessage)
        <li>
            <div class="comment-main-level">
                <!-- Avatar -->
                <div class="comment-avatar"><img class="link info-user" data-user-id="{{ $wallMessage->user->id }}"
                                                 src="{{ $wallMessage->user->avatarPath() }}" alt=""></div>
                <!-- Contenedor del Comentario -->
                <div class="comment-box">
                    <div class="comment-head">
                        <h6 class="comment-name">{{ $wallMessage->user->linkFullName() }} <span class="monitor">{{ $wallMessage->user->isMonitor($course->id) ? '(Monitor)' : '' }}</span></h6>
                        <span> Publicado {{ $wallMessage->created_at->diffForHumans() }}
                            : {{ $wallMessage->created_at }}</span>
                        @if($wallMessage->user->isMe())
                            <i class="delete-message fa fa-trash" data-message-id="{{ $wallMessage->id }}"></i>
                            @if($wallMessage->achievement_id==null)
                                <i class="edit-message fa fa-pencil-square-o" data-message-id="{{ $wallMessage->id }}"
                                   data-message="{{ $wallMessage->message }}"></i>
                            @endif
                        @endif
                        <i class="reply fa fa-reply"></i>
                    </div>
                    <div class="comment-content">
                        @if($wallMessage->achievement_id!=null)
                            @include('course.partials.achievement_image',['achievement'=>$wallMessage->achievement])
                            <div class="inlineblock">
                                <h4 class="">{{ $wallMessage->message }}</h4>

                                <p>{{ $wallMessage->achievement->description }}</p>
                            </div>
                        @else
                            {{{ $wallMessage->message }}}
                        @endif
                    </div>
                </div>
            </div>
            <!-- Respuestas de los comentarios -->
            <ul class="comments-list reply-list">
                @foreach($wallMessage->replies as $reply)
                    <li>
                        <!-- Avatar -->
                        <div class="comment-avatar"><img class="link info-user"
                                                         data-user-id="{{ $wallMessage->user->id }}"
                                                         src="{{ $reply->user->avatarPath() }}" alt=""></div>
                        <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name"> {{ $reply->user->linkFullName() }} <span class="monitor">{{ $wallMessage->user->isMonitor($course->id) ? '(Monitor)' : '' }}</span></h6>
                                <span> Publicado {{ $reply->created_at->diffForHumans() }}
                                    : {{ $reply->created_at }}</span>
                                @if($reply->user->isMe())
                                    <i class="delete-message fa fa-trash" data-message-id="{{ $reply->id }}"></i>
                                    <i class="edit-message fa fa-pencil-square-o" data-message-id="{{ $reply->id }}"
                                       data-message="{{ $reply->message }}"></i>
                                @endif
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
                            <h6 class="comment-name">{{ Auth::user()->linkFullName() }}</h6>
                        </div>
                        <div class="comment-content">
                            {{ Form::open(['route'=>['wall_save_reply_path',$course->id,$wallMessage->id],'class'=>'validate-form','novalidate'=>true]) }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <textarea id="message" name="message" class="form-control message"
                                              placeholder="Deja tu mensaje..." required="true"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a class="btn-cancel-reply btn btn-danger btn-sm">Cancelar</a>
                                    <button type="submit" class="btn-send-reply btn btn-primary btn-sm">Publicar
                                    </button>
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