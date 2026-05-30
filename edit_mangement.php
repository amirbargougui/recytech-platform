
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

<!-- Products -->
<?php
include 'components/connect.php';

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];

    $get_schedule = $conn->prepare("SELECT * FROM schedule WHERE id = ?");
    $get_schedule->execute([$schedule_id]);
    $schedule = $get_schedule->fetch();
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Edit Scheduling</h6>
            <a href="#">Show All</a>
        </div>
        <?php if ($schedule): ?>
            <form method="POST" action="code_mangement.php">
                <input type="hidden" name="schedule_id" id="schedule_id" value="<?=$schedule['id'];?>">

                <div class="form-group">
                    <label for="date" id="icon"><i class="fas fa-calendar-alt"></i></label>
                    <input type="date" name="date" id="date" value="<?=$schedule['collection_date'];?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="time" id="icon"><i class="fas fa-clock"></i></label>
                    <input type="time" name="time" id="time" value="<?=$schedule['collection_time'];?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="location" id="icon"><i class="fas fa-map-marked-alt"></i></label>
                    <input type="text" name="location" id="location" value="<?=$schedule['location'];?>" placeholder="Location" class="form-control"/>
                </div>

                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary" name="update_scheduling">Update Scheduling</button>
                </div>
            </form>
        <?php else: ?>
            <p>Schedule not found.</p>
        <?php endif; ?>
    </div>
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