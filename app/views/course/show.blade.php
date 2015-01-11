@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
@stop

@section('content')
    <h1 class="section-title"><span>Módulos</span></h1>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <thead>
                    <td>Módulo</td>
                    <td class="hidden-xs">Descripción</td>
                    <td >Fecha de inicio</td>
                    <td>Fecha de finalización</td>
                    <td>Opciones</td>
                    </thead>
                </tr>
                @foreach($course->modules as $module)
                    <tr>
                        <td>{{ $module->name }}</td>
                        <td class="hidden-xs">{{ Str::limit($module->description, $limit = 80, $end = '...') }}</td>
                        <td>{{ $module->start_date }}</td>
                        <td>{{ $module->end_date }}</td>
                        <td><a class="btn btn-primary" href="{{ route('module_path',[$course->id,$module->id]) }}">Entrar</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop