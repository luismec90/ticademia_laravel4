@extends('layouts.default')

@section('js')
    {{ HTML::script('assets/js/duels.js') }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-primary" onclick="getDuel()">Duelo</button>
            Cantidad de usuarios conectados: <b id="totalUsersOnline"></b>
        </div>
    </div>

    <div class="modal fade" id="modal-duel-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Notificación</h4>
                </div>
                <div id="modal-body-duel-notification" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop