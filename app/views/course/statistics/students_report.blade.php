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
    <h1 class="section-title"><span>Reporte</span></h1>
    {{ Form::open(['class'=>'validate-form','method'=>'GET']) }}
    <div class="row">
        @foreach($course->modules as $module)
            <div class="col-xs-4 col-sm-3 col-md-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="{{ $module->id }}"
                               name="modules[]" {{ Input::has('modules') && is_array(Input::get('modules')) && in_array($module->id,Input::get('modules')) ?  "checked" :"" }}>
                        Módulo {{ $module->id }}
                    </label>
                </div>
            </div>
        @endforeach
        <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="true"
                           name="allModules" {{ (Input::get('allModules',false) ? "checked" :"") }}>
                    Todos
                </label>
            </div>
        </div>
        <div class="col-xs-4 col-sm-3 col-md-2">
            {{ Form::submit('Ver',['class'=>'btn btn-primary']) }}
        </div>
    </div>


    {{ Form::close() }}
    @if(!is_null($data))
        <div class="row">
            <div class="col-xs-12">
                <hr>
            </div>
        </div>
        <h2 class="text-center">
            <div class="pull-right">
                {{ Form::open(['route'=>['download_module_report_path',$course->id]]) }}
                <div class="hide">
                    @foreach($course->modules as $module)

                        <input type="checkbox" value="{{ $module->id }}"
                               name="modules[]" {{ Input::has('modules') && is_array(Input::get('modules')) && in_array($module->id,Input::get('modules')) ?  "checked" :"" }}>
                    @endforeach
                        <input type="checkbox" value="true"
                               name="allModules" {{ (Input::get('allModules',false) ? "checked" :"") }}>
                </div>

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
            <div class="col-xs-12" style="overflow: auto;">
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
                        @foreach($modules as $moduleID)
                            <td>
                                Módulo {{ $moduleID }}
                            </td>
                        @endforeach
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
                            @foreach($modules as $moduleID)
                                <td>
                                    <?php $index = "module_$moduleID"; ?>
                                    {{ $user->$index }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br>
    @endif

@stop