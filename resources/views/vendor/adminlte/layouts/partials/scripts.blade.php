<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->

@if (current_page('boleteria/productos/add'))
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<!-- jQuery UI 1.11.4 -->
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
<script src="{{ asset('lte/app.js') }}" type="text/javascript"></script>
@else
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
@endif

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
]); ?>
</script>

<script  type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>



<script src="{{asset('fullcalendar-3.3.1/lib/moment.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function() {
    var BASEURL = "{{ url('/') }}";
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: '2017-04-16',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events:  BASEURL + '/events'
    });

  });

</script>




<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

@if (current_page('admin_boleteria'))
<script src="{{asset('plugins/chartjs/Chart.js')}}"></script>
<script type="text/javascript">
$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre ", "Noviembre","Diciembre"],
    datasets: [
      {
        label: "Ventas",
        fillColor: "#1ca3f1",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: [{{$enero}}, {{$febrero}}, {{$marzo}}, {{$abril}}, {{$mayo}}, {{$junio}}, {{$julio}}, {{$agosto}}, {{$septiembre}}, {{$octubre}}, {{$noviembre}}, {{$diciembre}}]
      }
    ]
  };

  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

});
</script>
@endif

<?php


?>

@if (current_page('admin_boleteria/inventario'))
<script src="{{asset('plugins/chartjs/Chart.js')}}"></script>
<script>
  $(function () {

    var areaChartData = {
      labels: {!! json_encode($variable) !!},
      datasets: [
        {
          label: "Vendidas",
          fillColor: "rgba(60,141,188,0.9)",
          data: {{json_encode($usarioventas)}}
        },
        {
          label: "Inventario",
          fillColor: "#ff2201",
          data: {{json_encode($usarioinventario)}}
        },
      ]
    };

    var BASEURL = "{{ url('/') }}";

    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = {!! json_encode($torta) !!};
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
@endif

@if (current_page('boleteria/productos/add'))
<script>
$(function () {
  //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  /* The todo list plugin */
  $(".todo-list").todolist({
    onCheck: function (ele) {
      window.console.log("The element has been checked");
      return ele;
    },
    onUncheck: function (ele) {
      window.console.log("The element has been unchecked");
      return ele;
    }
  });

});
</script>
@endif


<script>
$(document).ready(function()
{
  if ($("#venderBoleta").length) {

    $(".serialID").click(function () {

  		var totalBoletas =  parseInt($("#totalBoletas").val());
      var infoValor = parseInt($(this).attr('info-Valor'));
  		if( $(this).is(':checked') ){
        resultado = totalBoletas+infoValor;
        $("#totalBoletas").val(resultado);
      } else {
        resultado = totalBoletas-infoValor;
        $("#totalBoletas").val(resultado)
      }
  	});



    $("#cedulaBoletas").change(function(e){

      e.preventDefault();

      data="";
      cedulaEnvio = $("#cedulaBoletas").val();
      url = "asociado/"+cedulaEnvio;

     $("#cargaAsociado").show();

      $.get(url, function(infoAsociado){

        if(infoAsociado.asociado == "No encontrado"){

        //  $('#codigo').prop("type", "text");
          $('#codigo').prop("name", "error");
          $('.codigo').val(infoAsociado.asociado);
          $('#nombre').val(infoAsociado.asociado);
          $("#cargaAsociado").hide();
          $("#venderBoleta").prop('disabled', true);

        }else{
          //$('#codigo').prop("type", "number");
          $('#codigo').prop("name", "codigo");
          $('.codigo').val(infoAsociado.codigo);
          $('#nombre').val(infoAsociado.nombre);
          $('#idAsociado').val(infoAsociado.id)
          $("#cargaAsociado").hide();
          $("#venderBoleta").prop('disabled', false);
        }




      });

    });

 


  }

});

 
</script>



<script>
$(document).ready(function()
{
  if ($("#nit").length) {

    $("#nit").change(function(e){

      e.preventDefault();
     
      nit = $("#nit").val();
      url = "nit/"+nit;     

     $("#cargaAsociado").show();

      $.get(url, function(infoNit){

        if(infoNit.estado == "false"){
          $('#nombre').val("No existe"); 
        }else{
          $('#nombre').val(infoNit.razon_social);           
        }        

      });

    });

 }

});
 
</script>


@if (current_page('solicitud/solicitar'))
<script>
 $('#producto_solicitud').change(function(){
  producto = $('#producto_solicitud').val()
  @foreach($rows as $key)
   valorProducto = {{$key->id}};
    if(valorProducto == producto){

      $("#monto").attr("min", "{{$key->monto_min}}");
      $("#monto").attr("max", "{{$key->monto_max}}");
      $("#monto").attr("placeholder", "maximo {{$key->monto_max}} Meses");
      $("#cuota").attr("min", "{{$key->cuota_min}}");
      $("#cuota").attr("max", "{{$key->cuota_max}}");
      $("#cuota").attr("placeholder", "maximo $ {{$key->cuota_max}}");

   }
    
  @endforeach

});
  


</script>
@endif