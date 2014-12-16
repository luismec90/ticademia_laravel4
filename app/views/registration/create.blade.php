@extends('layouts.default')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Registro</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

            @include('layouts.partials.errors')

            {{ Form::open(['route'=>'register_path','novalidate'=>true,'class'=>'validate-form']) }}

                <!-- Nombres Form Input -->
                <div class="form-group">
                        {{ Form::label('nombres','Nombres:') }}
                        {{ Form::text('nombres',null,['class'=>'form-control','required'=>true]) }}
                </div>

                 <!-- Apellidos Form Input -->
                <div class="form-group">
                    {{ Form::label('apellidos','Apellidos:') }}
                    {{ Form::text('apellidos',null,['class'=>'form-control','required'=>true]) }}
                </div>

                <!-- Fecha de nacimiento Form Input -->
                <div class="form-group">
                        {{ Form::label('fecha_nacimiento','Fecha de nacimiento:') }}
                        {{ Form::text('fecha_nacimiento',null,['class'=>'form-control datepickerBirthday date','required'=>true]) }}
                </div>

                <!-- Sexo Form Input -->
                <div class="form-group">
                        {{ Form::label('sexo','Sexo:') }}
                        {{ Form::select('sexo', [''=>'Seleccionar...','f' => 'Femenino', 'm' => 'Masculino'],null,['class'=>'form-control','required'=>true]) }}
                </div>
                
                <!-- Email Form Input -->
                <div class="form-group">
                        {{ Form::label('email','Correo electrónico:') }}
                        {{ Form::email('email',null,['class'=>'form-control email','required'=>true]) }}
                </div>
                
                <!-- Contraseña Form Input -->
                <div class="form-group">
                        {{ Form::label('password','Contraseña:') }}
                        {{ Form::password('password',['class'=>'form-control','required'=>true]) }}
                </div>
                
                <!-- Repetir contraseña Form Input -->
                <div class="form-group">
                        {{ Form::label('password_confirmation','Repetir contraseña:') }}
                        {{ Form::password('password_confirmation',['class'=>'form-control','required'=>true]) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Enviar',['class'=>'btn btn-success']) }}
                </div>

            {{ Form::close() }}
        </div>
    </div>
@stop