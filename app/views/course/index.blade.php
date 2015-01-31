@extends('layouts.default')

@section('content')
<h1 class="section-title"><span>Mis Cursos</span></h1>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td class="col-xs-3"></td>
                    <td>Curso</td>
                    @if(Auth::check())
                        <td>Opciones</td>
                    @endif
                </tr>
            </thead>
            @foreach($courses as $course)
            <tr>
                <td><img class="img img-responsive img-thumbnail" src="{{ $course->imagePath() }}"></td>
                <td>
                   <h3> {{ $course->subject->name }}</h3>
                    <p>{{  $course->subject->description }}</p>
                </td>
                @if(Auth::check())
                <td>
                    @if(Auth::user()->isStudent($course->id) || Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id))
                        <a class="btn btn-primary" href="{{ route('course_path',$course->id) }}">Entrar</a>
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
            {{ $course=null }}
        </table>
    </div>
</div>
@stop