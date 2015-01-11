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
            var data = google.visualization.arrayToDataTable([
                ['Fecha', 'Evaluaciones intentadas', 'Evaluaciones resueltas'],
                ['2004', 1000, 400],
                ['2005', 1170, 460],
                ['2006', 660, 1120],
                ['2007', 1030, 540]
            ]);

            var options = {
                legend: {position: 'bottom'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart-quizzes'));

            chart.draw(data, options);
        }
    </script>
@stop
@stop
@section('content')
    <h1 class="section-title"><span>Evaluaciones</span></h1>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Distribución de niveles</h3>
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