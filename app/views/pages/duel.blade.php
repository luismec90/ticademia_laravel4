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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div >
                                <p>Has sido seleccionado para participar en un duelo con <span id="ask-duel-el-la"></span> estudiante <b id="ask-duel-defiant-name"></b>.</p>
                                <p>¿Deseas aceptar?</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <img id="avatar-defiant-user" class="media-object img-thumbnail avatar img-responsive" width="auto" src="">
                        </div>
                    </div>
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


    <div id="iframe-duel-container" class="hide">
        <div class="container">
            <div class="panel panel-custom">
                <div class="panel-heading">
                    <h3 id="panel-iframe-duel-title">Duelo</h3>
                </div>
                <div class="panel-body">
                    <iframe id="iframe-duel-quiz"></iframe>
                </div>
            </div>
        </div>
    </div>
@stop