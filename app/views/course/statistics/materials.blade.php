@extends('layouts.default')
@section('js')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(
                {{ json_encode($data) }}
            );

            var options = {
                is3D: true,
                'height': 400
            };

            var chart = new google.visualization.PieChart(document.getElementById('distribucion-niveles'));
            chart.draw(data, options);
        }
        $(document).ready(function () {
            $(window).resize(function(){
                drawChart();
            });
        });
    </script>
@stop
@section('content')
    <h1 class="section-title"><span>Materiales</span></h1>
    <h3 class="text-center">Total de materiales: {{ $totalMaterials }}</h3>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Diagrama de líneas y barras con cantidad de videos vistos y porcentaje promedio de visualización vs. tiempo (en dias), desde el dia de inicio hasta el día actual</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="distribucion-niveles"></div>
                    </center>

                </div>
            </div>
        </div>
    </div>
@stop