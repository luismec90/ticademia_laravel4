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

    <div class="modal" id="modal-duel-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Notificación</h4>
                </div>
                <div id="modal-body-duel-notification" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-finding-opponent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Buscando oponente</h4>
                </div>
                <div id="" class="modal-body">
                    <center><img width="64" height="64" src="{{ asset('assets/images/general/loading2.gif') }}">
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-ask-duel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Te han retado</h4>
                </div>
                <div id="modal-body-ask-duel" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="rejectDuel()" class="btn btn-default" data-dismiss="modal">Rechazar
                    </button>
                    <button type="button" onclick="acceptDuel()" class="btn btn-primary" data-dismiss="modal">Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-show-duel-quiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Duelo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <b>¿Cuánto es 2+2?</b>
                        </div>
                        <div class="col-xs-4">
                            <input id="input-show-duel-quiz" class="form-control" type="text">
                        </div>
                        <div class="col-xs-4">
                            <button onclick="answerQuizDuel()" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <smal>Tu oponete es el estudiante: <span id="opponent-id"></span></smal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop