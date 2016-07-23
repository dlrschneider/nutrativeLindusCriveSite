<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
	
   <div class="containerComponente">
      <h2></h2>
      <div id="graficoAlimentosCadastrados"></div>
   </div>
   
   <div class="containerComponente">
      <div id="graficoClientesOciosos"></div>
   </div>
   
   <div class="containerComponente">
      <div id="graficoAtivoInativo"></div>
   </div>
</div> <!-- FECHA O CONTAINER -->
<script>
$(function () {
   $('#graficoAlimentosCadastrados').highcharts({
       credits: {
         enabled: false
       },
       chart: {
           type: 'column'
       },
       title: {
           text: 'Cadastro mensal de alimentos'
       },
       subtitle: {
           text: 'Quantidade de alimentos sendo cadastrados pelos clientes no dia'
       },
       xAxis: {
           categories: [<?=$listaDias;?>],
           crosshair: true
       },
       yAxis: {
           min: 0,
           title: {
               text: 'Quantidade'
           }
       },
       tooltip: {
           headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
           pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
               '<td style="padding:0"><b>{point.y}</b></td></tr>',
           footerFormat: '</table>',
           shared: true,
           useHTML: true
       },
       plotOptions: {
           column: {
               pointPadding: 0.2,
               borderWidth: 0
           }
       },
       series: [{
           name: 'Quantidade',
           data: [<?=$listaQtdeCadastraram;?>]

       }]
   });
   
   $('#graficoClientesOciosos').highcharts({
      credits: {
         enabled: false
      },
      chart: {
          type: 'column'
      },
      title: {
          text: 'Clientes com alimentação atrasada'
      },
      subtitle: {
          text: 'Quantidade de clientes que não cadastraram a alimentação no dia'
      },
      xAxis: {
          categories: [<?=$listaDias;?>],
          crosshair: true
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Quantidade'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
          name: 'Quantidade',
          data: [<?=$listaQtdeClientes;?>]

      }]
  });

   $('#graficoAtivoInativo').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
      },
      title: {
          text: 'Clientes Ativos x Inativos'
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
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
              }
          }
      },
      series: [{
          name: 'Quantidade',
          colorByPoint: true,
          data: [{
              name: 'Ativos',
              y: <?=$qtdeAtivos;?>
          }, {
              name: 'Inativos',
              y: <?=$qtdeInativos;?>,
          }]
      }]
  });
});
</script>