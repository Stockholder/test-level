@extends('layouts.scaffold')
@section('main')
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Este é o resultado do seu teste'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Resultado',
            data: [
                ['Erros',   45.0],
                {
                    name: 'Acertos',
                    y: 12.8,
                    sliced: true,
                    selected: true
                }
            ]
        }]
    });
});
    
</script>
  <div class="row-fluid">
    <div class="title span12" style="text-align:center;">
      <p>
        <img style="-webkit-user-select: none; cursor: -webkit-zoom-in;" src="http://www.gpcon.com.br/UserFiles/Logo-Centro-Europeu.png" width="107" height="162">
      </p>
      <h3>Parabéns você concluiu seu teste</h3>
      <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
  </div>
@stop