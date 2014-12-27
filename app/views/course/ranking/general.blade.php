@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
    {{ HTML::style('assets/libs/datatables/css/dataTables.bootstrap.css') }}
@stop
@section('js')
    {{ HTML::script('assets/libs/datatables/js/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/libs/datatables/js/dataTables.bootstrap.js') }}
    <script>
        $(document).ready(function () {
            $('#table-ranking').dataTable({
                "language": {
                    "url": "{{ asset('assets/libs/datatables/js/spanish.lang') }}"
                }
            });
        });
    </script>
@stop
@section('content')
    <h1 class="section-title"><span>Ranking General</span></h1>

    <div class="row">
        <div class="col-xs-12">

            <table id="table-ranking" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <td>Posición</td>
                    <td class="col-xs-3 col-sm-2 col-md-1">Avatar</td>
                    <td>Nombre</td>
                    <td>Puntaje</td>
                </tr>
                </thead>
                <tbody>
                @foreach($ranking as $index => $user)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td class="col-xs-3 col-sm-2 col-md-1">@include('layouts.partials.avatar_square',['user'=>$user,'size'=>70])</td>
                        <td>{{ $user->fullName() }}</td>
                        <td>{{ $user->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <br>
        </div>
    </div>
@stop