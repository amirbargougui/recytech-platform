<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}


if(isset($_POST['cancel'])){

    $id = $_POST['id'];
    $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_orders->execute(['canceled', $id]);
 }

 if(isset($_POST['delivered'])){

    $id = $_POST['id'];
    $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_orders->execute(['delivered', $id]);
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


            <!-- orders -->
                        <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                            <?php
    $grand_total = 0;
    $select_orders = $conn->prepare("SELECT * FROM `orders`");
    $select_orders->execute();
    if($select_orders->rowCount() > 0){
        while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_product->execute([$fetch_order['product_id']]);
            if($select_product->rowCount() > 0){
                while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                    $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                    $grand_total += $sub_total;
?>
<div class="box">
    <div class="col">
        <p class="title"><i class="fas fa-calendar"></i><?= $fetch_order['date']; ?></p>
        <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="" style='max-width : 300px;'>
        <p class="price"></i> <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?> DT </p>
        <h3 class="name"> <?= $fetch_order['name']; ?></h3>
        <p class="grand-total">grand total : <span></i> <?= $grand_total; ?></span> DT</p>
    </div>
    <div class="col">
        <p class="title">billing address</p>
        <p class="user"><i class="fas fa-user"></i><?= $fetch_order['name']; ?></p>
        <p class="user"><i class="fas fa-phone"></i><?= $fetch_order['number']; ?></p>
        <p class="user"><i class="fas fa-envelope"></i><?= $fetch_order['email']; ?></p>
        <p class="user"><i class="fas fa-map-marker-alt"></i><?= $fetch_order['address']; ?></p>
        <p>products ordered :  <?= $fetch_product['name']; ?></p>
        <p class="title">status</p>
        <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo 'green';}elseif($fetch_order['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_order['status']; ?></p>
        <?php
            
            if ($fetch_order['status'] == 'in progress') {
            ?>
            
        <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $fetch_order['id']; ?>">
            <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('cancel this order?');">
        </form>
        <?php  } if ($fetch_order['status'] == 'in progress') {
            ?>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $fetch_order['id']; ?>">
            <input type="submit" value="order delivered" name="delivered" class="delete-btn" onclick="return confirm('order delivered?');">
        </form>

        <?php } ?>
        </br> <hr>
    </div>
</div>
<?php
                }
            }else{
                echo '<p class="empty">product not found!</p>';
            }
        }
    }else{
        echo '<p class="empty">no orders found!</p>';
    }
?>
                    </div>
                </div>
            </div>
            <!-- orders -->

            
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/script.js"></script>

    <?php include 'components/alert.php'; ?>
</body>

</html>