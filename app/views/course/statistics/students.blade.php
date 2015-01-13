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
            var data3 = google.visualization.arrayToDataTable(
                    {{ json_encode($data3) }}
            );
            var data4 = google.visualization.arrayToDataTable(
                    {{ json_encode($data4) }}
            );

            var options = {
                is3D: true,
                'height': 400,
                legend: {position: 'top'}
            };

            var options2 = {
                vAxes: {
                    0: {title: 'Conexiones', logScale: false, minValue: 0}
                },
                'height': 400,
                legend: {position: 'top'}
            };

            var options3 = {
                vAxes: {
                    0: {title: 'Conexiones', minValue: 0}
                },
                hAxes: {
                    0: {title: 'Hora del día (0-23)'}
                },
                'height': 400
            };

            var options4 = {
                vAxes: {
                    0: {title: 'Estudiantes (%)', minValue: 0}
                },
                'height': 400
            };

            var chart = new google.visualization.PieChart(document.getElementById('distribucion-niveles'));
            chart.draw(data, options);

            var chart2 = new google.visualization.LineChart(document.getElementById('conections-per-day'));
            chart2.draw(data2, options2);

            var chart3 = new google.visualization.LineChart(document.getElementById('conections-per-hour'));
            chart3.draw(data3, options3);

            var chart4 = new google.visualization.LineChart(document.getElementById('levels-per-day'));
            chart4.draw(data4, options4);
        }
        $(document).ready(function () {
            $(window).resize(function () {
                drawChart();
            });
        });
    </script>
@stop
@section('content')
    <h1 class="section-title"><span>Estudiantes</span></h1>
    <h3 class="text-center">Total de estudiantes matriculados: {{ $totalStudents }}</h3>
    <br>
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Distribución de niveles</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="distribucion-niveles"></div>
                    </center>

                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Distribución de niveles por día</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="levels-per-day"></div>
                    </center>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Conexiones por día</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="conections-per-day"></div>
                    </center>

                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Conexiones por hora</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="conections-per-hour"></div>
                    </center>

                </div>
            </div>
        </div>
    </div>
@stop