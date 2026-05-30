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
                          <a href="recyclage.php" class="dropdown-item active ">Refund</a>
                              <a href="produit.php" class="dropdown-item">Recycling product</a>
                          </div>  
                      </div>                                    </div>
            </nav>
        </div>
        <!-- Sidebar End -->

             

        <?php
    require '../config.php';

// Call the getConnexion() method from the config class to establish a database connection
$pdo = config::getConnexion();

if(isset($_POST['delete'])){
    $codepr = $_POST['codepr'];
    $delete_product = $pdo->prepare("DELETE FROM `remboursement` WHERE codepr = ?");
    $delete_product->bindParam(1, $codepr);
    $delete_product->execute();
   
}

// Prepare and execute the query to fetch remboursement from the database
$get_remboursement = $pdo->prepare("SELECT * FROM `remboursement`");
$get_remboursement->execute();

// Fetch the data from the query result
$remboursement = $get_remboursement->fetchAll();     // returns an array containing all of the remaining rows in the result set
// Prepare and execute the query to delete the data from the database
?>

<!-- Content Start -->
<div class="content">
    <!-- Search -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <form method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Product Code">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Search -->

    <!-- Products -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Product Code</th>
                            <th scope="col">Id</th>
                            <th scope="col">Purchase date</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if search query is set
                        if(isset($_GET['search'])){
                            $search = $_GET['search'];
                            $query = "SELECT * FROM remboursement WHERE codepr LIKE '%$search%' ";
                        } else {
                            $query = "SELECT * FROM remboursement ORDER BY id DESC";
                        }

                        $result = $pdo->query($query);
                        if ($result->rowCount()> 0) {
                            while ($item = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>{$item['codepr']}</td>";
                                echo "<td>{$item['id']}</td>";
                                echo "<td>{$item['date_achat']}</td>";
                                echo "<td>{$item['numero']}</td>";
                                echo "<td>{$item['description']}</td>";
                                echo "<td>";
                                echo "<form method='POST' action=''>";
                                echo "<input type='hidden' name='codepr' value='{$item['codepr']}'>";
                                echo "<button type='submit' name='delete' class='btn btn-danger btn-sm'><i class=></i> Delete</button>";
                                echo "</form>";
                             //   echo "<a href='edit_precycler.php?id={$item['id']}' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> Edit</a>";
                             echo "<td>
                             <button type='button' class='btn btn-danger btn-sm' style='height:40px' onclick=\"location.href='edit.php?cc={$item['codepr']}'\">Edit</button>
                           </td>";
                      
                             echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button id="export-btn" class="btn btn-primary mb-2">Export to Excel</button>

        </div>
    </div>
    <!-- Products -->
</div>
<!-- Content End -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<script>
// Get the table element
const table = document.querySelector('table');

// Add an event listener to the "Export to Excel" button
document.querySelector('#export-btn').addEventListener('click', () => {
  // Convert the table to a workbook object
  const workbook = XLSX.utils.table_to_book(table);

  // Save the workbook as an Excel file
  XLSX.writeFile(workbook, 'table.xlsx');
});
</script>




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