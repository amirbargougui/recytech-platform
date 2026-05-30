<?php

   include_once '../Model/donor.php';

    include_once  "../Controller/donorC.php";
    $error = "";

$donor= null;
$donor= new donorC();
if (
    
    
    isset($_POST["Name"]) &&		
    isset($_POST["Email"]) && 
    isset($_POST["Address"]) &&
    isset($_POST["CardName"]) &&
    isset($_POST["CreditCardNum"]) &&
    isset($_POST["BilingAdress"]) &&
    isset($_POST["ZipCode"]) &&
    isset($_POST["Cvv"]) &&
    isset($_POST["ExpMonth"]) &&
    isset($_POST["ExpYear"]) &&
    isset($_POST["Amount"]) 
    
) {
    if (
        
        !empty($_POST["Name"]) && 
        !empty($_POST["Email"]) &&
        !empty($_POST["Address"]) &&
        !empty($_POST["CardName"]) &&
        !empty($_POST["CreditCardNum"]) &&
        !empty($_POST["BilingAdress"]) &&
        !empty($_POST["ZipCode"]) &&
        !empty($_POST["Cvv"]) &&
        !empty( $_POST["ExpMonth"]) &&
        !empty($_POST["ExpYear"]) &&
        !empty($_POST["Amount"]) 
     
        
        
    ) {
       

        $donor=new donor(
            $_POST["Name"],
            $_POST["Email"],
            $_POST["Amount"],
           $_POST["Address"],
           $_POST["CardName"],
           $_POST["CreditCardNum"],
           $_POST["BilingAdress"],
           $_POST["Cvv"], 
         $_POST["ExpMonth"],		
           $_POST["ExpYear"],
          $_POST["ZipCode"],
           $id
          
      );
     
      $donorC->modifierdonations($donor, $_POST['id_donation']);
      header('Location:afficherdonations.php');
  
  }
}
    else
        $error = "Missing information";
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
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <?php include'Sidebar.php'  ?>


        <!-- Content Start -->
        <div class="content">

        <?php include'Topbar.php'  ?>


            <!-- Table Start -->
            <?php
			if (isset($_POST['id_donation'])){
				$donor = $donorC->recupererdonations($_POST['id_donation']);
            
				
		?>
            <form action="" method="POST"  name="ajout" enctype="multipart/form-data">
                                       <table style="position: relative; left: 550px; top: 40px;">
                               
                                           
   <tr >
<td style="color: white; top: -42px; position: relative;"><label for="type">ID</label></td>
                                               <td style="color: white; position: relative; left: 20px; top: -50px;"><input type="number" name="id" id="id" value="<?php echo $donor['id_donation']; ?>"></td>
                                              
                                               
                                           </tr>
                                           <tr >
                                               <td style="color: white; top: -42px; position: relative;"><label for="type">name</label></td>
                                               <td style="color: white; position: relative; left: 20px; top: -40px;"><input type="text" name="name" id="name" value="<?php echo $donor['Name']; ?>"></td>
                                              
                                               
                                           </tr>
                                           
                                           <tr>
                                               <td style="color: white; position: relative; top: -32px;"><label for="adress">adress</label></td>
                                               <td style="position: relative; left: 25px; top: -32px;"><input type="adress" name="adress" id="adress" value="<?php echo $donor['Address']; ?>"></td>
                                           </tr>
                                         
         
                                           <tr> 
                                               <td ><button  style="position: relative; left: 300px; top: 25px;" type="submit" >Modifier</button></td>
                                               <td><input style="position: relative; left: 118px; top: 25px;" type="reset" value="Annuler"></td>
                                           </tr>
                                      
                                      
                                     
                                 
                                       </table>
                                   </form>
                                   <?php
		}
		?>

            <!-- Table End -->
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