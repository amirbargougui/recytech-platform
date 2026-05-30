<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

// Process form data after submission
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Check if a new image file has been uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE){
        
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = create_unique_id().'.'.$ext;
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_folder = 'uploaded_files/'.$rename;
        
        // Check if the image size is within limit
        if($image_size > 2000000){
            $warning_msg[] = 'Image size is too large!';
        }else{
            // Update product image field in the database with the new filename
            $update_product = $conn->prepare("UPDATE `products` SET `name`=?, `price`=?, `image`=? WHERE `id`=?");
            $update_product->execute([$name, $price, $rename, $id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = 'Product updated!';
        }
    }else{
        // No new image file has been uploaded, update the product data in the database without changing the image field
        $update_product = $conn->prepare("UPDATE `products` SET `name`=?, `price`=? WHERE `id`=?");
        $update_product->execute([$name, $price, $id]);
        $success_msg[] = 'Product updated! No image changed';
    }
}

if(isset($_POST['add'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_files/'.$rename;

   if($image_size > 2000000){
      $warning_msg[] = 'Image size is too large!';
   }else{
      $add_product = $conn->prepare("INSERT INTO `products`(id, name, price, image) VALUES(?,?,?,?)");
      $add_product->execute([$id, $name, $price, $rename]);
      move_uploaded_file($image_tmp_name, $image_folder);
      $success_msg[] = 'Product added!';
   }

}

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    // check if the product has any related orders
    $check_orders = $conn->prepare("SELECT COUNT(*) FROM orders WHERE product_id = ?");
    $check_orders->execute([$id]);
    $num_orders = $check_orders->fetchColumn();
    if($num_orders > 0) {
        // delete related orders first
        $delete_orders = $conn->prepare("DELETE FROM orders WHERE product_id = ?");
        $delete_orders->execute([$id]);
        $delete_orders = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
        $delete_orders->execute([$id]);
    }
    // delete the product
    $delete_product = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_product->execute([$id]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}




		// Query the database for the total revenue and number of orders per day
		$sql = "SELECT date, SUM(price * qty) AS revenue, COUNT(*) AS num_orders FROM orders GROUP BY date";
		$stmt = $conn->query($sql);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Convert the data into arrays that can be used in the chart
		$dates = array();
		$revenues = array();
		$num_orders = array();
		foreach ($data as $row) {
			$dates[] = $row['date'];
			$revenues[] = $row['revenue'];
			$num_orders[] = $row['num_orders'];
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
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
    <link href="css/product.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">



        <!-- Sidebar Start -->
        <?php include 'Sidebar.php'  ?>
       <!-- Sidebar End -->
         <!-- Content Start -->
        <div class="content">
                        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">


                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>


            <section style="margin-left:30px;" class="product-form">

                <form action="" method="POST" id='add-form' enctype="multipart/form-data">
                    <h3>Add product</h3>
                    <p>product name <span>*</span></p>
                    </br><span id='nameError2'></span>
                    <input type="text" name="name" id="add_name" placeholder="enter product name" required maxlength="50" class="box">
                    <p>product price <span>*</span></p>
                    </br><span id='nameError3'></span>
                    <input type="number" name="price" placeholder="enter product price" required min="0" max="9999999999" maxlength="10" class="box">
                    <p>product image <span>*</span></p>
                    <input type="file" name="image" required accept="image/*" class="box">
                    <button type="submit" class="btn btn-add" name="add" id="add_submit" value="add product" > Add Product </button>
                </form>

            </section>

            <hr>

            <section style="margin-left:30px;" class="product-form">
            
            <form action="" method="POST" enctype="multipart/form-data">
                    <h3>Delete product</h3>
                    <p>product Id <span>*</span></p>
                    <input type="text" name="id" placeholder="enter product name" required maxlength="50" class="box">
                    <input type="submit" class="btn btn-add" name="delete" value="delete product">
                </form>
            </section>


            <!-- Products -->
                        <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">image</th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
$get_products = $conn->prepare("SELECT * FROM `products`");
$get_products->execute();
$products = $get_products->fetchAll();

foreach($products as $product){
    echo "<tr>";
    echo "<td>{$product['id']}</td>";
    echo "<form method='POST' action='' id='update-form' onsubmit='return validateForm()'>";
    echo "<td><input style= '  width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #191C24;
    color: white;
    ' 
    type='text' name='name' value='{$product['name']}'>";
    echo "</br><span id='nameError'></span> </td>";


    echo "<td><input style= '  width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #191C24;
    color: white;
    ' type='text' name='price' value='{$product['price']}'>";
    echo "</br><span id='nameError1'></span> </td>";

    echo "<td><img src='uploaded_files/{$product['image']}' width='100'></br>";
    echo "<input type='file' name='image' accept='image/*' class='box'></td>";
    echo "<input type='hidden' name='id' value='{$product['id']}'>";
    echo "<td><button style='margin:5px;' type='submit' name='update' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> Update</button>";
    echo "</form>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='id' value='{$product['id']}'>";
    echo "<button type='submit' style='margin:5px;' name='delete' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}



// Process form data after submission
                           ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            
            <!-- Products -->




            <br>
<br>
<br>
<br>

            <!-- index.php -->

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Revenue and Order Chart</h6>
                            <canvas id="chart"></canvas>
                        </div>

                    </div>
                
                
    </div>
    <script>
// Create a chart with Chart.js
var ctx = document.getElementById('chart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Revenue',
            data: <?php echo json_encode($revenues); ?>,
            borderColor: 'rgb(255, 99, 132)',
            fill: false,
            yAxisID: 'y-axis-1' // assign to first y-axis
        }, {
            label: 'Number of Orders',
            data: <?php echo json_encode($num_orders); ?>,
            borderColor: 'rgb(54, 162, 235)',
            fill: false,
            yAxisID: 'y-axis-2' // assign to second y-axis
        }]
    },
    options: {
        scales: {
            yAxes: [{
                id: 'y-axis-1', // first y-axis
                type: 'linear',
                position: 'left',
                ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                        return '$' + value; // format the y-axis label as currency
                    }
                }
            }, {
                id: 'y-axis-2', // second y-axis
                type: 'linear',
                position: 'right',
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/controle.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/script.js"></script>

    <?php include 'components/alert.php'; ?>
</body>

</html>