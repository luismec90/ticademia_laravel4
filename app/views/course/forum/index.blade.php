@extends('layouts.default')

@section('css')
{{ HTML::style('assets/css/forum.css') }}
@stop


@section('content')
<h1 class="section-title"><span>Foro</span> </h1>
<div id="div-forum">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 text-right">
                    {{ $topics->links() }}
                </div>
            </div>
            <table id="table-forum" class="table">
                <tr>
                    <td></td>
                    <td>Publicación</td>
                    <td>Respuestas</td>
                    <td>Última respuesta</td>
                </tr>
                @foreach($topics as $topic)
                <tr class="topic">
                    <td class="col-xs-3 col-sm-2 col-md-1">@include('layouts.partials.avatar_square',['user'=>$topic->user])</td>
                    <td>
                        <div class="name row">
                            <div class="col-xs-12">
                                <a href="{{ route('topic_path',[$course->id,$topic->id]) }}" class="link"><b>{{ $topic->name }}</b></a>
                            </div>
                        </div>
                        <div class="information row">
                            <div class="col-xs-12">
                            Publicado <b>{{ $topic->created_at->diffForHumans() }}</b>: {{ $topic->created_at }}, por <b>{{ $topic->user->fullName() }}</b>
                            </div>
                        </div>
                    </td>
                    <td>{{ $topic->replies->count() }}</td>
                    <td class="information">
                    @if(!is_null($topic->lastReply))
                        La última respuesta fue <b>{{ $topic->lastReply->created_at->diffForHumans() }}</b>: {{ $topic->lastReply->created_at }}, por <b>{{ $topic->lastReply->user->fullName() }}</b></td>
                    @else
                    N/A
                    @endif
                </tr>
                @endforeach
            </table>
            <div class="row">
                <div class="col-xs-12 text-right">
                    {{ $topics->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop