@extends('layouts.default')
@section('css')
{{ HTML::style('assets/css/course.css') }}
@stop

@section('content')
<h1 class="section-title"><span>{{ $course->subject->name }}</span></h1>
<div class="container">
    <div class="row">
        <div class="col-xs-12">

        </div>
    </div>
</div>
@stop