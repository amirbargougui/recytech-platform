<?php
session_start();



if($_SESSION['login']=="")
{

    header("location: signup.php");
}


include  "../Model/client.php";
include  "../Controller/ClientC.php";

$clientc= new ClientC();
$liste=$clientc->afficherClients();
                                     
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RecyTech Users</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <?php include 'Sidebar.php'  ?>


        <!-- Content Start -->
        <div class="content">

        <?php include 'Topbar.php'  ?>


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
          <div class="col-12">

                            <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Users</h6>
                                <table class="table table-responsive">
                                    <thead> 
                                    
                                        <tr>
                                                <th scope="col">Last Name</th>
                                                <th scope="col" >First Name</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >Telephone</th>
                                                <th scope="col" >Adress</th>
                                                <th scope="col" >Sexe</th>
                                                <th scope="col" >Date Of Birth</th>
                                                <th scope="col" >Photo</th>
                                                <th scope="col" >Role</th>
                                                <th scope="col" >Status</th>
                                                <th scope="col" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                             
                                        foreach($liste as $row){
                                      ?>
                                        <tr>
                                            <td><?php echo $row['nom']; ?></td>
                                            <td><?php echo $row['prenom']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['tel']; ?></td>
                                            <td><?php echo $row['adresse']; ?></td>
                                            <td><?php echo $row['sexe']; ?></td>
                                            <td><?php echo $row['date_nais']; ?></td>
                                            <td><img src="../Views/<?php echo $row['image']; ?>" heigth="200" width=150></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['statut']; ?></td>
                                            <td>
                                                <?php if($row['statut'] == "Verified"){ ?>
                                                    <a class="btn btn-danger" href="BloquerClient.php?id=<?PHP echo $row['id']; ?>">Block</a>
                                                <?php } ?>
                                                <?php if($row['statut'] == "Bloquer"){ ?>
                                                    <a class="btn btn-success" href="DebloquerClient.php?id=<?PHP echo $row['id']; ?>">Unblock</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                                <?php
                                            }
                                    
                                        ?>  
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
                                        </div>
                                        </div>
            <!-- Table End -->


            <?php include 'footer.php'  ?>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
   

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>


