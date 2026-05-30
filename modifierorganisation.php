<?php
   include_once '../Controller/organisationC.php';
   include_once '../Model/organisation.php';

    $error = "";

    // create adherent
    $organisation = null;

    // create an instance of the controller
    $organisationC = new organisationC();
    if (
        isset($_POST["id"]) &&
		isset($_POST["name"]) &&		
        isset($_POST["adress"]) && 
        isset($_POST["details"])
    ) {
        if (
            !empty($_POST["id"]) && 
			!empty($_POST['name']) &&
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
                 $_POST['file']=$_POST['img'];
                 echo "erreur";

                }
             //END FILE//
            $organisation = new organisation(
                
				$_POST['name'],
                $_POST['details'],
                $_POST['adress'],
                $_POST['image']

				
               
            );
            $organisationC->modifierorganisation($organisation, $_POST['id']);
            header('Location:afficherorganisation.php');
        }
        else
            $error = "Missing information";
    }    
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

            
            <!-- Widgets End -->
            <?php
			if (isset($_POST['id'])){
				$organisation = $organisationC->recupererorganisation($_POST['id']);
            
			
		?>
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

                                    <form action="" method="POST" id="form_modorg" name="ajout" enctype="multipart/form-data">

                                       <table >
                               
                                           
                                                    <tr >
                                            <td ><label for="type">ID</label></td>
                                               <td ><input type="number" name="id" id="id" value="<?php echo $organisation['id']; ?>"></td>
                                              
                                               
                                           </tr>
                                           <tr >
                                               <td ><label for="type">name</label></td>
                                               <td ><input type="text" name="name" id="name" value="<?php echo $organisation['name']; ?>"></td>
                                              
                                               
                                           </tr>
                                           
                                           <tr>
                                               <td ><label for="adress">adress</label></td>
                                               <td ><input type="text" name="adress" id="adress" value="<?php echo $organisation['adress']; ?>"></td>
                                           </tr>
                                           <tr>
                                               <td ><label for="sujet">details</label></td>
                                               <td ><input type="text" name="details" id="details" value="<?php echo $organisation['details']; ?>"></td>
                                           </tr>
                                           <tr> 
                                           

                                           <td ><label for="sujet">image</label></td>
                                               <td ><input type="file" name="image" id="image" value="<?php echo $organisation['image']; ?>"></td>


                                       </tr>
                                         
                                           <tr>
                                               <!-- <td ><button  type="submit" >Modifier</button></td> -->
                                               <td><input type="reset" value="Annuler"></td>
                                               <td><input type="submit" value="modifier"></td>
                                           </tr>
                                      
                                      
                                     
                                 
                                       </table>
                                   </form>
                                   <?php
		}
		?>
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
    <script src="js/csorg.js"></script>
</body>

</html>