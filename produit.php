    <?php      
    require '../config.php';


    if (isset($_POST['add'])) {   // ++ variable 
        $codepr = $_POST['codepr'];     
        $type = $_POST['type'];
        $dated = $_POST['dated'];
        $datef = $_POST['datef'];
        $quantite = $_POST['quantite'];
        $status = $_POST['status'];   
    
    
        $conn = new config();
        $pdo = $conn::getConnexion();
        $query = "INSERT INTO precycler (codepr,type , dated, datef ,quantite, status ) VALUES (?,?,?, ?, ?, ?)"; 

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $codepr);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $datef);
        $stmt->bindParam(4, $datef);  // link parameters to a prepared statement before executing it --> no  injection attacks 
        $stmt->bindParam(5, $quantite);  
        $stmt->bindParam(6, $status);  


        // Execute the statement
        $stmt->execute();
    
    }



// Call the getConnexion() method from the config class to establish a database connection
$pdo = config::getConnexion();

if(isset($_POST['delete'])){
    $codepr = $_POST['codepr'];
    $delete_product = $pdo->prepare("DELETE FROM `precycler` WHERE codepr = ?");
    $delete_product->bindParam(1, $codepr);
    $delete_product->execute();
}
// Prepare and execute the query to fetch remboursement from the database
$get_precycler = $pdo->prepare("SELECT * FROM `precycler`");
$get_precycler->execute();

// Fetch the data from the query result
$precycler = $get_precycler->fetchAll();     // returns an array containing all of the remaining rows in the result set
// Prepare and execute the query to delete the data from the database


$search = isset($_GET['search']) ? $_GET['search'] : '';  

// Use $search as the parameter for the prepared statement
$get_items = $pdo->prepare("SELECT codepr, type, dated, datef, quantite, status 
    FROM precycler 
    WHERE codepr = ?");
$get_items->execute([$search]);
$items = $get_items->fetchAll();
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin - Admin </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
      

            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>RecyTech</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Kaabi Nousseiba</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="AfficherUsers.php" class="nav-item nav-link "><i class="fa fa-user-alt me-2"></i>Users</a>
                    <div class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Shop</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Add_product.php" class="dropdown-item ">Add Products</a>
                            <a href="View_Orders.php" class="dropdown-item">View Orders</a>
                        </div>  
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>schedulling</a>
                      <div class="dropdown-menu bg-transparent border-0">
                           <a href="schedulling.php" class="dropdown-item ">Add item type</a>
                            <a href="Management_schedule.php" class="dropdown-item ">Collection Management</a>
                            <a href="calendrier.php" class="dropdown-item ">Display calendar appointments</a>
                            
                        </div>  
                    <a href="Afficherdonations.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Donation</a>
                    <a href="afficherorganisation.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Organisation</a>
                    <a href="h" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Blog</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Recycle</a>
                          <div class="dropdown-menu bg-transparent border-0">
                          <a href="recyclage.php" class="dropdown-item  ">Refund</a>
                              <a href="produit.php" class="dropdown-item active">Recycling product</a>
                          </div>  
                      </div>                                    </div>
            </nav>
        </div>
        <!-- Sidebar End -->



<!-- Content Start -->
<div class="content">
    <!-- Products -->
    <div class="main">

<section class="signup" id="subscribe">
<div class="container">
<div class="signup-content">
<div class="signup-form">
    

    <!-- Products -->
</div>

<div class="content0">
    <!-- Products -->
    <div class="container-fluid pt-2 px-2">
        
        <div class="bg-secondary text-center rounded p-3">
            
            <div class="table-responsive">
                
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    
  
                 
                
<form method="POST" class="register-form" onsubmit="return check()">  

<div class="form-group" style="max-width: 850px;">
  <form method="GET" class="mb-3">
    <h1 class="form-title">Product For Recycling</h1>
    <div class="row" style="margin-bot: 10px;">
      <div class="col-md-2">
        <input type="text" name="codepr" id="codepr" placeholder="Product code"  class="form-control" />
        <span id="error" style="inline-block:none;"></span>
      </div>
      <div class="col-md-2">
        <input type="text" name="type" id="tpe" placeholder="Type"  class="form-control" />
      </div>
      <div class="col-md-2">
        <input type="text" name="dated" id="dated" placeholder="Start date"  class="form-control" />
        <span id="errorDate" style="inline-block:none;"></span>
      </div>
      <div class="col-md-2">
        <input type="text" name="datef" id="datef" placeholder="End date"  class="form-control" />
        <span id="errorDate1" style="inline-block:none;"></span>
      </div>
      <div class="col-md-2">
        <input type="text" name="quantite" id="quantite" placeholder="Quantity"  class="form-control" />
      </div>
      <div class="col-md-2">
        <input type="text" name="status" id="status" placeholder="Status"  class="form-control" />
        <span id="errorStatus" style="inline-block:none;"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <button type="submit" name="add" id="add" class="btn btn-danger btn-sm">Add</button>
        <button type="submit" name="delete" class="btn btn-danger btn-sm"><i></i>Delete</button>
        <button type="submit" name="edit" class="btn btn-danger btn-sm"><i></i>Edit</button>
      </div>
    </div>
  </form>
</div>





                
<div class="content0">
    <!-- Products -->
    
    <div class="container-fluid pt-2 px-2">

        <div class="bg-secondary text-center rounded p-3">
            
            <div class="table-responsive">
                
            <div class="table-responsive">
    <table  class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-white">
                <th scope="col">Product Code</th>
                <th scope="col">Type</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Define how many results you want per page
            $results_per_page = 4;

            // Determine the total number of pages //pagination
            $num_pages = ceil(count($precycler) / $results_per_page);

            // Determine which page the user is on
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            // Determine the starting and ending indices of the results for the current page
            $start_index = ($page - 1) * $results_per_page;
            $end_index = $start_index + $results_per_page - 1;

            // Loop through the fetched products and display them in the table for the current page
            for ($i = $start_index; $i <= $end_index; $i++) {
                if (isset($precycler[$i])) {
                    $item = $precycler[$i];
                    echo "<tr>";
                    echo "<td>{$item['codepr']}</td>";
                    echo "<td>{$item['type']}</td>";
                    echo "<td>{$item['dated']}</td>";
                    echo "<td>{$item['datef']}</td>";
                    echo "<td>{$item['quantite']}</td>";
                    echo "<td>{$item['status']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add pagination links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
    
        // Display the pagination links
        for ($page_num = 1; $page_num <= $num_pages; $page_num++) {
            if ($page_num == $page) {
                echo "<li class='page-item active'><a class='page-link' href='#'>$page_num</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?page=$page_num'>$page_num</a></li>";
            }
        }
        ?>
    </ul>
</nav>

            </div> 
        </div>
    </div>  
    <!-- Products -->

<?php
 $conn = new config();
 $pdo = $conn::getConnexion();
 $query = "SELECT dated, SUM(quantite) AS total_quantity
 FROM precycler
 GROUP BY dated;"; 



 $stmt = $pdo->prepare($query);

 // Execute the statement
 $stmt->execute();

// Store the results in arrays for use with Chart.js
$dates = [];
$quantities = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dates[] = $row["dated"];
    $quantities[] = $row["total_quantity"];
}

// Close the database connection
$conn = null;



?>

<!-- Include the Chart.js library -->
<script src="lib/chart/chart.min.js"></script>

<!-- Create a canvas element to hold the chart -->



<div class="col-sm-12 col-xl-6" style="margin: 20px;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4"> Stat</h6>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

<script>
// Get the canvas element
var ctx = document.getElementById("myChart").getContext("2d");

// Create the chart
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Quantity',
            data: <?php echo json_encode($quantities); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>




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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/success.js"></script>


    