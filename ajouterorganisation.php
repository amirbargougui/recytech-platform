<?php

include_once '../Controller/organisationC.php';
include_once '../Model/organisation.php';

$error = "";
$organisation=null;
$organisationC= new organisationC();

if (
    
    
    isset($_POST["name"]) &&		
    isset($_POST["adress"]) && 
    isset($_POST["details"]) 
    
) {
    if (
        
        !empty($_POST["name"]) && 
        !empty($_POST["adress"]) &&
        !empty($_POST["details"]) 
     
        
        
    ) {
       
         //START FILE//
         $tmpName = $_FILES['image']['tmp_name'];
         $name = $_FILES['image']['name'];
         $size = $_FILES['image']['size'];
         $error = $_FILES['image']['error'];
         $type = $_FILES['image']['type'];

         $tabExtension = explode('.', $name);
         $extension = strtolower(end($tabExtension));

         $extensionsAutorisees = ['jpg', 'png', 'jpeg', 'gif'];
         $tailleMax = 400000;

         if(in_array($extension, $extensionsAutorisees) && $size <= $tailleMax && $error == 0){
             $_POST['image'] =$_FILES['image']['name'];

             move_uploaded_file($tmpName, './upload/'.$name);
         }
         else{
             echo "erreur";
         }
         //END FILE//
        
    
   
          $organisation = new organisation(
          $_POST['name'],
          $_POST['details'], 
          $_POST['adress'],
          $_POST['image']
        
          
      );
     
      $organisationC->ajouterorganisation($organisation);
      header('Location:afficherorganisation.php');
  
  }
}
    else
        $error = "Missing information";
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
</head>
<body>
    
    <div class="container-fluid position-relative d-flex p-0">
        
    


        <?php include'Sidebar.php'  ?>


        <!-- Content Start -->
        <div class="content">

        <?php include'Topbar.php'  ?>
        <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">

            
                        <style>
    form {
        width: 50%;
        margin: auto;
    }
    
    label {
        display: block;
        margin-bottom: 5px;
    }
    
    input[type="text"], input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    
    input[type="submit"], input[type="reset"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    
    input[type="submit"]:hover, input[type="reset"]:hover {
        background-color: #45a049;
    }
</style>

<form action="ajouterorganisation.php" method="POST" name="ajout" id="form_modorg" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" onkeypress="return valiadressChar(event)">
    </div>
    <div class="form-group">
        <label for="adress">Address</label>
        <input type="text" name="adress" id="adress">
    </div>
    <div class="form-group">
        <label for="details">Details</label>
        <input type="text" name="details" id="details" onkeypress="return valiadressChar(event)">
    </div>
    <div class="form-group">
        <label for="icon">Image</label>
        <input type="file" id="icon" class="fas fa-image" name="image">
    </div>
    <div class="form-group">
        <br>
        <!-- <button type="submit">Envoyer</button> -->
        <input type="submit" value="envoyer">
        <input type="reset" value="Annuler">
    </div>
</form>


        <?php include'footer.php'  ?>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


 <!-- Template Javascript -->
    <script src="js/csorg.js"></script>

    <script src="js/main.js"></script>
  
   
</body>

</html>