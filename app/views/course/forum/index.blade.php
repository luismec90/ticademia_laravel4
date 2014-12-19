@extends('layouts.default')

@section('js')
{{ HTML::script('assets/js/forum.js') }}
<script>
    var wall_path="{{ route('wall_path',$course->id) }}";
</script>
@stop
@section('content')
<h1 class="section-title"><span>{{ $course->subject->name }}: Foro</span> </h1>
<div id="div-forum">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 text-right">
                    {{ $topics->links() }}
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>Tema</td>
                    <td>Propietario</td>
                    <td>Fecha</td>
                </tr>
                @foreach($topics as $topic)
                <tr>
                    <td><a href="{{ route('topic_path',[$course->id,$topic->id]) }}" class="link"><b>{{ $topic->name }}</b></a></a><br>{{ $topic->description }}</td>
                    <td>{{ $topic->user->fullName() }}</td>
                    <td>{{ $topic->created_at }}</td>
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