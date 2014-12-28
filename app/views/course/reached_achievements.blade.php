@extends('layouts.default')

@section('content')
    <h1 class="section-title"><span>Mis logros</span> </h1>
    <div class="row">
        <div class="col-xs-12">
            {{ Achievement::has(); }}
        </div>
    </div>
@stop