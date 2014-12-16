@extends('layouts.default')
@section('content')
<section class="section  section-cta">
    <div class="container">
        <h1 class="section-title"><span>Registro</span></h1>
        <div class="row">
            <div class="col-xs-12">
                @include('layouts.partials.errors')
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-6">
                    {{ Form::open(['route'=>'register_path','novalidate'=>'rquired','class'=>'validate-form']) }}
                    <!-- Nombres Form Input -->
                    <div class="form-group">
                        {{ Form::label('first_name','Nombres:') }}
                        {{ Form::text('first_name',null,['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <!-- Apellidos Form Input -->
                    <div class="form-group">
                        {{ Form::label('last_name','Apellidos:') }}
                        {{ Form::text('last_name',null,['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <!-- Fecha de nacimiento Form Input -->
                    <div class="form-group">
                        {{ Form::label('birth_date','Fecha de nacimiento:') }}
                        {{ Form::text('birth_date',null,['class'=>'form-control datepickerBirthday']) }}
                    </div>
                    <!-- Genero Form Input -->
                    <div class="form-group">
                        {{ Form::label('gender','Género:') }}
                        {{ Form::select('gender', [''=>'Seleccionar...','f' => 'Femenino', 'm' => 'Masculino'],null,['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <!-- Email Form Input -->
                    <div class="form-group">
                        {{ Form::label('email','Correo electrónico:') }}
                        {{ Form::email('email',null,['class'=>'form-control email','required'=>'required']) }}
                    </div>
                    <!-- Contraseña Form Input -->
                    <div class="form-group">
                        {{ Form::label('password','Establecer una contraseña:') }}
                        {{ Form::password('password',['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <!-- Repetir contraseña Form Input -->
                    <div class="form-group">
                        {{ Form::label('password_confirmation','Confirmar contraseña:') }}
                        {{ Form::password('password_confirmation',['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="checkbox">
                                <label>
                                {{ Form::checkbox('checkbox-terms', 'true', false, ['id' => 'checkbox-terms','required'=>'required']); }} Acepto los <a class="link" href="{{ route('terms_path') }}" target="_blank">Términos y condiciones de uso</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {{ Form::submit('Enviar',['class'=>'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-6">
                    <h2>Registro con redes sociales</h2>
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="btn btn-block btn-social btn-facebook" href="{{ route('login_facebook_path') }}">
                            <i class="fa fa-facebook"></i> Registrase con Facebook
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="btn btn-block btn-social btn-google-plus" href="{{ route('login_google_path') }}">
                            <i class="fa fa-google-plus"></i> Registrase con Google
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop