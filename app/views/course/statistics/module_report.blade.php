@extends('layouts.default')

@section('css')
    {{ HTML::style('assets/libs/datatables/css/dataTables.bootstrap.css') }}
@stop
@section('js')
    {{ HTML::script('assets/libs/datatables/js/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/libs/datatables/js/dataTables.bootstrap.js') }}
    <script>
        $(document).ready(function () {
            $('#table-students').dataTable({
                "language": {
                    "url": "{{ asset('assets/libs/datatables/js/spanish.lang') }}"
                }
            });
        });
        info_user_path = "{{ route('info_user_path',$course->id) }}";
    </script>
@stop

@section('content')
    <h1 class="section-title"><span>Reportes</span></h1>
    <div class="row">

        {{ Form::open(['class'=>'validate-form','method'=>'GET']) }}

        <div class="col-sm-4 col-sm-offset-4">
            {{ Form::label('module','Módulo:') }}
            {{ Form::select('moduleID', $selectModules, Input::get('moduleID',null), array('class' => 'form-control','required'=>true)) }}
        </div>

        <div class="col-sm-4">
            <br>
            {{ Form::submit('Ver',['class'=>'btn btn-primary']) }}
        </div>

        {{ Form::close() }}

    </div>
    @if(!is_null($data))
        <div class="row">
            <div class="col-xs-12">
                <hr>
            </div>
        </div>
        <h2 class="text-center">{{ $module->name }}
            <div class="pull-right">
                {{ Form::open(['route'=>['download_module_report_path',$course->id]]) }}

                {{ Form::hidden('moduleID',Input::get('moduleID'),['required'=>true]) }}

                <!-- Submit Form Input -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-download"> </i> Exportar a
                                Excel
                            </button>
                        </div>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </h2>
        <div class="row">
            <div class="col-xs-12">
                <table id="table-students" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <td>
                            Grupo
                        </td>
                        <td>
                            DNI
                        </td>
                        <td>
                            Correo
                        </td>
                        <td>
                            Apellidos
                        </td>
                        <td>
                            Nombres
                        </td>
                        <td>
                            Porcentaje (%)
                        </td>
                    </tr>
                    </thead>
                    @foreach($data as $user)
                        <tr>
                            <td>
                                {{ $user->group }}
                            </td>
                            <td>
                                {{ $user->dni }}
                            </td>
                            <td>
                                <a class='link info-user' data-user-id='{{ $user->id }}'> {{ $user->email }}</a>

                            </td>
                            <td>
                                {{ $user->last_name }}
                            </td>
                            <td>
                                {{ $user->first_name }}
                            </td>
                            <td>
                                {{ $user->percentage }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@stop