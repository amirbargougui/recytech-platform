<?php

include_once '../Controller/organisationC.php';
include  "../Controller/donorC.php";

    //include '../config.php';
	$organisationC=new organisationC();
    $donor= new donorC();
    $listeorganisations=$organisationC->afficherorganisation(); 
    $listee=$organisationC->afficherorganisation(); 
    
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="utf-8">
    <title>RecyTech</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="details">

    <!-- Favicon -->
    <link href="img/favicon.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Organisation', 'Donation'],
                <?php
                    foreach ($listee as $row1){
                ?>
                ['<?php echo $row1['name']; ?>', <?php echo $donor->recupererOrganisationByDonation($row1['id'])->rowCount();  ?>],
                <?php
                }
                ?>
                ['', 0]
            ]);

            var options = {
                title: 'Les Statistiques',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        


        <?php include'Sidebar.php'  ?>


        <!-- Content Start -->
        <div class="content">

        <?php include'Topbar.php'  ?>
     <!-- Recent Sales Start -->
     <div class="container-fluid pt-4 px-4">
  <div class="bg-secondary text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">ORGANISATIONS</h6>
      <a href="" class="text-white">Show All</a>
    </div>
    <div class="table-responsive">
      <div id="piechart" style="width: 100%; height: 500px;"></div>
      <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
          <tr class="text-white">
            <th style="color: gold;">ID</th>
            <th scope="col" style="color: gold;">Name</th>
            <th scope="col" style="color: gold;">Details</th>
            <th scope="col" style="color: gold;">Address</th>
            <th scope="col" style="color: gold;">Image</th>
            <th scope="col" style="color: gold;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($listeorganisations as $organisation) { ?>
            <tr>
              <td style="color: white;"><?php echo $organisation['id']; ?></td>
              <td style="color: white;"><?php echo $organisation['name']; ?></td>
              <td style="color: white;"><?php echo $organisation['details']; ?></td>
              <td style="color: white;"><?php echo $organisation['adress']; ?></td>
              <td><?php echo "<img src='upload/{$organisation['image']}' width='50' class='rounded-circle'>"; ?></td>
              <td>
                <form method="POST" action="modifierorganisation.php">
                  <input type="submit" class="btn btn-warning" id="modifier" value="Modifier">
                  <input type="hidden" value="<?PHP echo $organisation['id']; ?>" name="id">
                </form>
                <form method="POST" action="supprimerorganisation.php">
                  <input type="submit" class="btn btn-danger" id="supprimer" value="Supprimer">
                  <input type="hidden" value="<?PHP echo $organisation['id']; ?>" name="id">
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <a href="ajouterorganisation.php" class="btn btn-success mt-3">Ajouter Organisation</a>
    </div>
  </div>
</div>


        
        <?php include'footer.php'  ?>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>