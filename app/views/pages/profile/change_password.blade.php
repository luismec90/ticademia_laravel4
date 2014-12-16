@extends('layouts.default')

@section('css')
{{ HTML::style('assets/css/profile.css') }}
@stop

@section('content')

<section class="section  section-cta">
    <div class="container">
        <h2 class="section-title"><span>Mi perfil</span></h2>
        <div class="col-sm-8 col-sm-offset-2">
            @include('layouts.partials.errors')
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li><a href="{{ route('profile_path') }}">Información general</a></li>
                            <li  class="active"><a>Cambiar contraseña</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                        <div class="tab-pane fade in active" >
                            {{ Form::open(['route'=>'update_password_path','class'=>'validate-form','novalidate'=>true, 'files' => true]) }}

                            <!-- Contraseña Form Input -->
                            <div class="form-group">
                            {{ Form::label('password','Contraseña nueva:') }}
                            {{ Form::password('password',['class'=>'form-control','required'=>'required']) }}
                            </div>

                            <!-- Repetir contraseña Form Input -->
                            <div class="form-group">
                            {{ Form::label('password_confirmation','Confirmar contraseña nueva:') }}
                            {{ Form::password('password_confirmation',['class'=>'form-control','required'=>'required']) }}
                            </div>

                            @if(!Auth::user()->password=="")
                                <!--  contraseña anterior Form Input -->
                                <div class="form-group">
                                {{ Form::label('old_password','Contraseña anterior:') }}
                                {{ Form::password('old_password',['class'=>'form-control','required'=>'required']) }}
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                    {{ Form::submit('Enviar',['class'=>'btn btn-primary btn-block']) }}
                                    </div>
                                </div>
                            </div>

                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
