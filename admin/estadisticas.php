<?php include("views/header.php");
require_once(__DIR__."/controllers/pedido.php");
include("views/menu.php");
$datos= $pedido -> mas_vendido();
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', { 'packages': ['corechart'] });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a datos table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var data = google.visualization.arrayToDataTable([
      ['Element', 'Density', { role: 'style' }],
      <?php  foreach ($datos as $key => $value): ?>
        ['<?php echo $value['nombre']; ?>', <?php echo $value['total_vendido']; ?>, 'gold'],            // English color name
         <?php endforeach; ?>
    ]);

    // Set chart options
    var options = {
      'title': 'Los productos más vendidos',
      'width': 400,
      'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>


  <div id="chart_div"></div>

  
  <?php include("views/footer.php");?>