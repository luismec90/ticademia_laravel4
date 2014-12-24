@extends('layouts.default')

@section('css')
{{ HTML::style('assets/libs/bootstrapvalidator/css/bootstrapValidator.min.css') }}
{{ HTML::style('assets/css/registro.css') }}
@stop

@section('js')
{{ HTML::script('assets/libs/bootstrapvalidator/js/bootstrapValidator.js') }}
{{ HTML::script('assets/libs/bootstrapvalidator/js/language/es_ES.js') }}
{{ HTML::script('assets/js/validation.js') }}
@stop

@section('content')

<section class="section  section-cta">
    <h2 class="section-title"><span>Notificaciones</span></h2>
    <div class="col-xs-12">
        @include('layouts.partials.errors')
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-hover">
                    <tr>
                        <td>Notificación</td>
                        <td>Ver</td>
                        <td>Fecha</td>
                    </tr>
                    @foreach($notifications as $notification)
                            <tr class="{{ $notification->viewed==0 ? "warning" : "" }}">
                                <td >
                                    {{ $notification->body }}
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route("show_notification_path",$notification->id) }}">Ver</a>
                                </td>
                                <td>
                                    {{ ucfirst($notification->created_at->diffForHumans()) }}: {{ $notification->created_at }}
                                </td>
                            </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {{ $notifications->links(); }}
    </div>
</section>
@stop