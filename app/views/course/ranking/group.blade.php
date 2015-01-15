@extends('layouts.default')
@section('css')
    {{ HTML::style('assets/css/course.css') }}
@stop

@section('content')
    <h1 class="section-title"><span>Ranking Grupal</span></h1>

    <div class="row">
        <div class="col-xs-12">
            @if(Auth::user()->isStudent($course->id))
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Posición</td>
                        <td>Grupo</td>
                        <td>Puntaje</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
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
            @endif
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
                        <td>
                            @if($index==0)
                                <img width="25" src="{{ asset('assets/images/general/gold_cup.png') }}">
                            @elseif($index==1)
                                <img width="25" src="{{ asset('assets/images/general/silver_cup.png') }}">
                            @elseif($index==2)
                                <img width="25" src="{{ asset('assets/images/general/bronze_cup.png') }}">
                            @endif
                            {{ $row->group }}</td>
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