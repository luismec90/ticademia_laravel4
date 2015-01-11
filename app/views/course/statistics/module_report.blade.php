@extends('layouts.default')
@section('js')

@stop
@section('content')
    <h1 class="section-title"><span>Reportes</span></h1>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            {{ Form::open(['route'=>['download_module_report_path',$course->id]]) }}

            <!--  Form Input -->
            <div class="form-group">
                {{ Form::label('module','Módulo:') }}
                {{ Form::select('module', $selectModules, null, array('class' => 'form-control','required'=>true)) }}
            </div>

            <!-- Submit Form Input -->
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        {{ Form::submit('Exportar a Excel',['class'=>'btn btn-primary']) }}
                    </div>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@stop