@extends('layouts.default')
@section('css')
{{ HTML::style('assets/libs/jquery-cropper/cropper.min.css') }}
{{ HTML::style('assets/css/profile.css') }}
@stop
@section('js')
{{ HTML::script('assets/libs/jquery-cropper/cropper.min.js') }}
{{ HTML::script('assets/js/profile.js') }}
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
                        <li class="active"><a>Información general</a></li>
                        <li><a href="{{ route('password_path') }}">Cambiar contraseña</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" >
                            {{ Form::model(Auth::user(),['route'=>'update_profile_path','class'=>'validate-form','novalidate'=>true]) }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <center>@include('layouts.partials.avatar_square',['user'=>Auth::user(),'size'=>200])
                                        <br>
                                        <a class="btn btn-primary" id="btn-modal-change-avatar">Cambiar imagen</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <hr>
                                </div>
                            </div>
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
                                {{ Form::text('birth_date',null,['class'=>'form-control datepickerBirthday','required'=>'required']) }}
                            </div>
                            <!-- Sexo Form Input -->
                            <div class="form-group">
                                {{ Form::label('gender','Sexo:') }}
                                {{ Form::select('gender', [''=>'Seleccionar...','f' => 'Femenino', 'm' => 'Masculino'],null,['class'=>'form-control','required'=>'required']) }}
                            </div>
                            <!-- Email Form Input -->
                            <div class="form-group">
                                {{ Form::label('email','Correo electrónico:') }}
                                {{ Form::email('email',null,['class'=>'form-control','readonly'=>'true']) }}
                            </div>
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
<div class="modal fade" id="modal-change-avatar">
    <div class="modal-dialog">
        {{ Form::open(['route'=>'change_avatar_path','class'=>'validate-form','novalidate'=>true,'files' => true]) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cambiar imagen</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <span class="btn btn-primary btn-file pull-right">
                            Seleccionar imagen...
                            {{ Form::file('avatar',['accept'=>'image/*','id'=>'btn-file-avatar','required'=>true]) }}
                            </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <br>
                    </div>
                </div>
                <div id="container-crop" >
                    <div class="bootstrap-modal-cropper">
                        <img id="preview-img-avatar" name="avatar" width="400" src="{{ Auth::user()->avatarPath() }}">
                    </div>
                </div>
                <input type="hidden" name="dataX" id="dataX" required="">
                <input type="hidden" name="dataY" id="dataY" required="">
                <input type="hidden" name="dataHeight" id="dataHeight" required="">
                <input type="hidden" name="dataWidth" id="dataWidth" required="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
        <!-- /.modal-content -->
        {{ Form::close() }}
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop
