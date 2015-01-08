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
                    <td>
                        Opciones
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
                        <td>
                                <a class='btn btn-primary' href="{{ route('share_achievement_path', [$course->id,$reachedAchievement->achievement->id]) }}">Compartir en TICademia</a>
                            <a class='btn btn-info btn-sm' onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ route('share_path', [$course->id, $reachedAchievement->id]) }}','MyWindow',width=600,height=300); return false;" href='#'> Compartir en Facebook </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop