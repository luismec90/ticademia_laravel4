@extends('layouts.default')

@section('content')
<h1 class="section-title"><span>Mis Cursos</span></h1>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <td class="col-xs-3"></td>
                    <td>Curso</td>
                    <td>Entrar</td>
                </tr>
            </thead>
            @foreach($courses as $course)
            <tr>
                <td><img class="img img-responsive img-thumbnail" src="{{ $course->imagePath() }}"></td>
                <td>
                    <h3> {{ $course->subject->name }}</h3>
                    <p>{{  $course->subject->description }}</p>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('course_path',$course->id) }}">Entrar</a>
                </td>
            </tr>
            @endforeach
            {{ $course=null }}
        </table>
    </div>
</div>
@stop