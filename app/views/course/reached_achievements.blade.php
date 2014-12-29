@extends('layouts.default')

@section('content')
    <h1 class="section-title"><span>Mis logros</span></h1>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-striped table_hover">
                <thead>
                <tr>
                    <td>
                        Imagen
                    </td>
                    <td>
                        Nombre
                    </td>
                    <td>
                        Descripción
                    </td>
                    <td>
                        Fecha
                    </td>
                </tr>
                </thead>
                @foreach($reachedAchievements as $reachedAchievement)
                    <tr>
                        <td>
                            @include('course.partials.achievement_image',['achievement'=>$reachedAchievement->achievement])
                        </td>
                        <td>
                            {{ $reachedAchievement->achievement->name }}
                        </td>
                        <td>
                            {{ $reachedAchievement->achievement->description }}
                        </td>
                        <td>
                            {{ ucfirst($reachedAchievement->created_at->diffForHumans()) }}
                            : {{ $reachedAchievement->created_at  }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop