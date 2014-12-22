@extends('layouts.default')
@section('css')
{{ HTML::style('assets/css/course.css') }}
@stop

@section('content')
<h1 class="section-title"><span>Calendario</span></h1>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <iframe id="iframe-calendar" src="https://www.google.com/calendar/embed?src=soporte.ticademia%40gmail.com&ctz=America/Bogota&title=Matem%C3%A1ticas%20B%C3%A1sicas&mode=WEEK&showTitle=0" style="border: 0" frameborder="0" scrolling="no" align="middle"></iframe>
        </div>
    </div>
</div>
@stop