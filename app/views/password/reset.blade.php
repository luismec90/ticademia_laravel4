@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Restablecer contraseña</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

        {{ Form::open(['class'=>'validate-form','novalidate'=>true]) }}

            {{ Form::hidden('token',$token) }}
            
            <!-- Email Form Input -->
            <div class="form-group">
                {{ Form::label('email','Correo electrónico:') }}
                {{ Form::email('email',null,['class'=>'form-control email','required ']) }}
            </div>
            
            <!-- Nueva contraseña Form Input -->
            <div class="form-group">
                {{ Form::label('password','Nueva contraseña:') }}
                {{ Form::password('password',['class'=>'form-control','required ']) }}
            </div>
            
            <!-- Confirmar contraseña Form Input -->
            <div class="form-group">
                {{ Form::label('password_confirmation','Confirmar contraseña:') }}
                {{ Form::password('password_confirmation',['class'=>'form-control','required ']) }}
            </div>

            <!-- Enviar contraseña button -->
            <div class="form-group">
                {{ Form::submit('Enviar',['class'=>'btn btn-success']) }}
            </div>


        {{ Form::close() }}
        </div>
    </div>
@stop