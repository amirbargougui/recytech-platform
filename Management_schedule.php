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

        <!-- Sidebar End -->
       
        <!-- Content Start -->
        <div class="content">

        <?php include'Topbar.php'  ?>
>

        <!-- Products -->
        <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Collection Management</h6>
                       
                        <a href="">Show All</a>
                        
                    </div>

                    <?php
    ob_start(); 
    include 'components/connect.php';
    if (isset($_POST['id'])) {
        $schedule_id = $_POST['id'];

        $delete_schedule = $conn->prepare("DELETE FROM `schedule` WHERE `id`=?");
        $delete_schedule->execute([$schedule_id]);

        // rediriger vers la page actuelle après la suppression
        echo "<script> window.location.href='Management_schedule.php';</script>";
        exit(); // stop the script execution after redirecting
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 10;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $get_item_types = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS item_types.id, item_types.name, schedule.id AS schedule_id, schedule.collection_date, schedule.collection_time, schedule.location 
        FROM item_types 
        LEFT JOIN schedule ON item_types.id = schedule.item_type_id
        WHERE item_types.name LIKE CONCAT('%', ?, '%')
        LIMIT {$start}, {$perPage}");
    $get_item_types->execute([$search]);
    $item_types = $get_item_types->fetchAll();

    $total = $conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
    $pages = ceil($total / $perPage);
    ?>

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Type Name" name="search" value="<?php echo $search ?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0">
            <thead>
                <tr class="text-white">
                    <th scope="col">Id Item</th>
                    <th scope="col">Type name</th>
                    <th scope="col">Id Schedule</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($item_types as $item_type) {
                    echo "<tr>";
                    echo "<td>{$item_type['id']}</td>";
                    echo "<td>{$item_type['name']}</td>";
                    echo "<td>{$item_type['schedule_id']}</td>";
                    echo "<td>{$item_type['collection_date']}</td>";
                    echo "<td>{$item_type['collection_time']}</td>";
                    echo "<td>{$item_type['location']}</td>";
                    // Fixed button onclick function call
                    echo "<td>
                        <a href='edit_mangement.php?id={$item_type['schedule_id']}'>
                            <button type='button' class='btn btn-primary' style='height:40px'>Edit</button>
                        </a>
                    </td>";
                    echo "<td>
                        <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this schedule?\")'>
                            <input type='hidden' name='id' value='{$item_type['schedule_id']}' />
                            <button type='submit' name='delete_schedule' class='btn btn-danger' style='height:40px'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </body>
    </table>
</div>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo "?page=$i&search=$search"; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php
$conn = null; // fermer la connexion
ob_end_flush(); // flush the output buffer after processing the script
?>


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