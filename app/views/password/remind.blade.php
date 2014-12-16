@extends('layouts.default')


@section('content')
    <div class="row">
        <div class="col-md-12">
             <h1 class="section-title"><span>Restablecer contraseña</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

        {{ Form::open(['class'=>'validate-form','novalidate'=>true]) }}

        <!-- Email Form Input -->
        <div class="form-group">
            {{ Form::label('email','Correo electrónico:') }}
            {{ Form::email('email',null,['class'=>'form-control email','required'=>true]) }}
        </div>
        
        <!-- Enviar contraseña button -->
        <div class="form-group">
           {{ Form::submit('Enviar',['class'=>'btn btn-primary']) }}
        </div>


        {{ Form::close() }}
        </div>
    </div>
@stop