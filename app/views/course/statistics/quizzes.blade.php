@extends('layouts.default')
@section('js')
@section('js')
    <script type="text/javascript"
            src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable(
                    {{ json_encode($data) }}
            );

            var options = {
                vAxes: {
                    0: {title: 'Evaluaciones', logScale: false, minValue: 0}
                },
                'height': 400,
                legend: {position: 'top'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart-quizzes'));

            chart.draw(data, options);
        }

        $(document).ready(function () {
            $(window).resize(function(){
                drawChart();
            });
        });
    </script>
@stop
@stop
@section('content')
    <h1 class="section-title"><span>Evaluaciones</span></h1>
    <h3 class="text-center">Total de evaluaciones: {{ $totalQuizzes }}</h3>
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Evaluaciones resueltas Vs Evaluaciones intentadas</h3>
                </div>
                <div class="panel-body">

                    <center>
                        <div id="chart-quizzes"></div>
                    </center>

                </div>
            </div>
        </div>
    </div>
@stop