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
                <br>
                La búsqueda se terminará en <b></b><span id="time-getting-duel">30</span> segundos </b>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelDuel()" class="btn btn-danger" data-dismiss="modal">Cancelar búsqueda
                </button>
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
                    <div class="col-sm-8">
                        <div>
                            <p>Has sido seleccionado para participar en un duelo con <span id="ask-duel-el-la"></span>
                                estudiante <b id="ask-duel-defiant-name"></b>.</p>

                            <p>¿Deseas aceptar?</p>
                          <p> Tienes  <b></b><span id="time-accepting-duel">30</span> segundos </b> para responder</p>
                            <p id="note-ask-for-duel">
                                <b>Nota:</b> Si acpetas el duelo no recibiras penalización en el ejercicio actual</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <img id="avatar-defiant-user" class="media-object img-thumbnail avatar img-responsive"
                             width="auto" src="">
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