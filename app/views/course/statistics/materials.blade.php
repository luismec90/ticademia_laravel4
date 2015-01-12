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

            var data2 = google.visualization.arrayToDataTable(
                    {{ json_encode($data2) }}
            );

            var options = {
                hAxis: {showTextEvery: 2},
                vAxes: {
                    0: {title: 'Videos', minValue: 0},
                    1: {title: 'Porcentaje promedio de reproducción (%)', minValue: 0, maxValue: 100}
                },
                series: {
                    0: {targetAxisIndex: 0},
                    1: {targetAxisIndex: 1}
                },
                legend: {position: 'top'},
                height: 400
            };

            var options2 = {
                hAxis: {showTextEvery: 2},
                vAxes: {
                    0: {title: 'PDFs', logScale: false, minValue: 0}
                },
                legend: {position: 'top'},
                height: 400
            };

            var chart = new google.visualization.ComboChart(document.getElementById('info-videos'));
            chart.draw(data, options);

            var chart2 = new google.visualization.ComboChart(document.getElementById('info-materials'));
            chart2.draw(data2, options2);
        }

        $(document).ready(function () {
            $(window).resize(function () {
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
                    <h3 class="panel-title">Distribución de PDFs vistos por día</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="info-materials"></div>
                    </center>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Diagrama de líneas y barras con cantidad de videos vistos y porcentaje
                        promedio de visualización vs. tiempo (en dias), desde el dia de inicio hasta el día actual</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="info-videos"></div>
                    </center>

                </div>
            </div>
        </div>
    </div>
@stop