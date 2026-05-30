<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4" style="height: 800px; width: 650px;">
                            <h6 class="mb-4">Users</h6>
                            <div id="pie-chart" class="chart-container" style="height: 400px; width: 600px;"></div>
                        </div>
                    </div>
                </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Client', 'Etat'],
      ['Blocked', <?php echo $clientc->recupererClientByEtat("Bloquer")->rowCount(); ?>],
      ['Verified', <?php echo $clientc->recupererClientByEtat("Verified")->rowCount(); ?>],
      ['Not Verified', <?php echo $clientc->recupererClientByEtat("Non Vérifé")->rowCount(); ?>]
    ]);

    var options = {
      title: '',
      backgroundColor: '#191C24',
      pieSliceTextStyle: {
        color: 'white'
      },
      pieSliceText: 'none', // hide percentage values

      colors: ['#b22222', '#EB1616', '#c90016'],
      legend: {
      position: 'top',
      alignment: 'center',
      textStyle: {
        color: 'gray'
      },
      markerShape: 'square', // display color indicators as squares
      markerBorderColor: 'white', // set the border color to white
    },
    markerShape: 'square', // display color indicators as squares
      markerBorderColor: 'white' // set the border color to white
      
    };

    var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
    chart.draw(data, options);
  }
</script>
