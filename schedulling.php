<?php
include 'components/connect.php';

if(isset($_POST['schedule_booking'])){
    $item_type_id = create_unique_id();
    $type = $_POST['type'];
    $type = filter_var($type, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $weight = $_POST['weight'];
    $weight = filter_var($weight, FILTER_SANITIZE_STRING); 
    $add_item = $conn->prepare("INSERT INTO `item_types`(id, name, description, weight) VALUES(?,?,?,?)");
    $add_item->execute([$item_type_id,$type,$description,$weight]);
    $success_msg[] = 'item type added!';
    }

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Afficher Donations</title>
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
        <!-- Spinner Start --
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        !-- Spinner End -->


        <?php include'Sidebar.php'  ?>


        <!-- Content Start -->
        <div class="content">

        <?php include'Topbar.php'  ?>


            <!-- Table Start -->
        

        <section style="margin-left:30px;" class="product-form">



        <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
      <div class="d-flex align-items-center justify-content-between mb-4">
           <div class="d-flex align-items-center justify-content-between mb-4">


        
           <form method="POST" class="register-form" enctype="multipart/form-data" onsubmit="return check()">
  <h3>Add Item Type</h3>
  <div class="form-group">
    <label for="type" id="icon"><i class="far fa-edit"></i></label>
    <input type="text" name="type" id="type" placeholder="Type of Waste" class="no-outline"/>
    <span id="error_type" style="display:none;"></span>
  </div>
  <div class="form-group">
    <label for="description" id="icon"></label>
    <textarea name="description" id="description" rows="7" cols="60" placeholder="Describe your item here..."></textarea>
    <span id="error_description" style="display:none;"></span>
  </div>
  
  <div class="form-group">
    <label for="weight" id="icon"><i class="fa fa-balance-scale"></i></label>
    <input type="text" name="weight" id="weight" placeholder="Weight (kg)" class="no-outline"/>
    <span id="error_weight" style="display:none;"></span>
  </div>
  <div class="form-group">
    <button type="submit" name="schedule_booking" id="schedule_booking">Submit</button>
  </div>
</form>



</section>
<hr>

<section style="margin-left:30px;" class="product-form">

  <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">Collection Management</h6>

        <a href="">Show All</a>

      </div>
      <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0">
          <thead>
            <tr class="text-white">
              <th scope="col">Id Item</th>
              <th scope="col">Type name</th>
              <th scope="col">Description</th>
              <th scope="col">Weight</th>
              <th colspan="2">Action</th>
            </tr>

                            </thead>
                            
                            <tbody>

<?php
ob_start(); 
include 'components/connect.php';



if (isset($_POST['delete_item_type'])) {
    $item_type_id1 = $_POST['item_type_id'];

    $delete_item_type = $conn->prepare("DELETE FROM `item_types` WHERE `id`=?");
    $delete_item_type->execute([$item_type_id1]);
   
        // rediriger vers la page actuelle après la suppression

echo " <script> window.location.href='schedulling.php';</script>";
    


    exit(); // stop the script execution after redirecting
}


$get_item_types = $conn->prepare("SELECT * FROM `item_types`");
$get_item_types->execute();
$item_types = $get_item_types->fetchAll();


foreach ($item_types as $item_type) {
    echo "<tr>";
    echo "<td>{$item_type['id']}</td>";
    echo "<td>{$item_type['name']}</td>";
    echo "<td>{$item_type['description']}</td>";
    echo "<td>{$item_type['weight']}</td>";

    echo "<td>
    <a href='edit_scheduling.php?id={$item_type['id']}'>
    <button type='button' class='btn btn-primary' style='height:40px' onclick=\"variationEditForm('{$item_type['id']}')\">Edit</button>
    </a>
  </td>";
    echo "<td>
            <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this item type?\")'>
                <input type='hidden' name='item_type_id' value='{$item_type['id']}' />
                <button type='submit' name='delete_item_type' class='btn btn-danger' style='height:40px'>Delete</button>

            </form>
         </td>";

    echo "</tr>";
}
ob_end_flush();
?>



                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Products -->
	

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
    <script src="js/schedule.js"></script>

</body>

</html>