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
            $('#table-forum').dataTable({
                "language": {
                    "url": "{{ asset('assets/libs/datatables/js/spanish.lang') }}"
                }
            });
        });
        info_user_path = "{{ route('info_user_path',$course->id) }}";
    </script>
@stop


@section('content')
<h1 class="section-title"><span>Foro</span> </h1>
<div id="div-forum">
    <div class="row">
        <div class="col-xs-12">
            <table id="table-forum" class="table">
                <thead>
                <tr>
                    <td></td>
                    <td>Publicación</td>
                    <td>Respuestas</td>
                    <td>Última respuesta</td>
                </tr>
                </thead>
                @foreach($topics as $topic)
                <tr class="topic">
                    <td class="col-xs-3 col-sm-2 col-md-1">@include('layouts.partials.link_avatar_square',['user'=>$topic->user])</td>
                    <td>
                        <div class="name row">
                            <div class="col-xs-12">
                                <a href="{{ route('topic_path',[$course->id,$topic->id]) }}" class="link"><b>{{ $topic->name }}</b></a>
                            </div>
                        </div>
                        <div class="information row">
                            <div class="col-xs-12">
                            Publicado <b>{{ $topic->created_at->diffForHumans() }}</b>: {{ $topic->created_at }}, por <b>{{ $topic->user->LinkFullName() }}</b>
                            </div>
                        </div>
                    </td>
                    <td>{{ $topic->replies->count() }}</td>
                    <td class="information">
                    @if($topic->replies->count())
                        La última respuesta fue <b>{{ $topic->replies[0]->created_at->diffForHumans() }}</b>: {{ $topic->replies[0]->created_at }}, por <b>{{ $topic->replies[0]->user->LinkFullName() }}</b></td>
                    @else
                    N/A
                    @endif
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
@stop