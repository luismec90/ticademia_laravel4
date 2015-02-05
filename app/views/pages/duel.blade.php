@extends('layouts.default')

@section('js')
    {{ HTML::script('assets/js/duels.js') }}
@stop

@section('content')
 <div class="row">
     <div class="col-xs-12">
         <button class="btn btn-primary" onclick="getDuel()">Duelo</button> Cantidad de usuarios conectados: <b id="totalUsersOnline"></b>
     </div>
 </div>
@stop