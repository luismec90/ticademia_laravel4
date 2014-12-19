@extends('layouts.default')

@section('js')
{{ HTML::script('assets/js/forum.js') }}
<script>
    var wall_path="{{ route('wall_path',$course->id) }}";
</script>
@stop
@section('content')
<h1 class="section-title"><span>{{ $course->subject->name }}: {{ $topic->name }}</span> </h1>
<div id="div-forum">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <td><a href="{{ route('topic_path',[$course->id,$topic->id]) }}" class="link"><b>{{ $topic->name }}</b></a></a><br>{{ $topic->description }}</td>
                        <td>{{ $topic->user->fullName() }}</td>
                        <td>{{ $topic->created_at }}</td>
                    </tr>
                    @foreach($topicReplies as $topicReply)
                        <tr>
                            <td>{{ $topicReply->reply }}</td>
                            <td>{{ $topicReply->user->fullName() }}</td>
                            <td>{{ $topicReply->created_at }}</td>
                        </tr>
                    @endforeach
                   </table>
                </div>
            </div>
            {{ $topicReplies->links() }}
        </div>
    </div>
</div>
@stop