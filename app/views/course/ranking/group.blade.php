@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
@stop

@section('content')
    <h1 class="section-title"><span>Ranking Grupal</span></h1>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr >
                    <td>Posición</td>
                    <td>Grupo</td>
                    <td>Puntaje</td>
                </tr>
                </thead>
                <tbody>
                <tr >
                    <td>{{ $userRanking['position'] }}</td>
                    <td>{{ $userRanking['group'] }}</td>
                    <td>{{ $userRanking['score'] }}</td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <hr>
                </div>
            </div>
            <table id="table-ranking" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <td>Posición</td>
                    <td>Grupo</td>
                    <td>Puntaje</td>
                </tr>
                </thead>
                <tbody>
                @foreach($ranking as $index => $row)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $row->group }}</td>
                        <td>{{ $row->score }}</td>
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