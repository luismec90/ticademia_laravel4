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
    <h1 class="section-title"><span>Ranking Individual</span></h1>

    <div class="row">
        <div class="col-xs-12">
            @if(Auth::user()->isStudent($course->id))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Puesto</th>
                    <th>Nombre</th>
                    <td>Puntos por quizzes</td>
                    <td>Puntos por duelos</td>
                    <td>Puntos por logros</td>
                    <td>Puntaje</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $userRanking['position'] }}</td>
                    <td>{{ $userRanking['fullName'] }}</td>
                    <td>{{ $userRanking['quizzes_score'] }}</td>
                    <td>{{ $userRanking['duels_score'] }}</td>
                    <td>{{ $userRanking['achievements_score'] }}</td>
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
            <table id="table-ranking" class="table table-striped table-bordered table-hover" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <td>Posición</td>
                    <td class="col-xs-3 col-sm-2 col-md-1"></td>
                    <td>Nombre</td>
                    <td>Puntaje</td>
                </tr>
                </thead>
                <tbody>
                @foreach($rankingCollection as $index => $user)

                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td class="col-xs-3 col-sm-2 col-md-1">@include('layouts.partials.link_avatar_square',['user'=>$user,'size'=>70])</td>
                        <td>
                            @if($index==0)
                                <img width="25" src="{{ asset('assets/images/general/gold_cup.png') }}">
                            @elseif($index==1)
                                <img width="25" src="{{ asset('assets/images/general/silver_cup.png') }}">
                            @elseif($index==2)
                                <img width="25" src="{{ asset('assets/images/general/bronze_cup.png') }}">
                            @endif
                            {{ $user->linkFullName() }}</td>
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