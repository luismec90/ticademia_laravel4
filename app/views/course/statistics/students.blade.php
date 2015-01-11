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
    </script>
@stop
@section('content')
    <h1 class="section-title"><span>Estudiantes</span></h1>
    <h3 class="text-center">Total de estudiantes matriculados: {{ $totalStudents }}</h3>
    <br>
    <div class="row">
        <div class="col-sm-6">
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
    </div>
@stop