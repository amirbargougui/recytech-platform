<?php

include_once '../Controller/organisationC.php';
    //include '../config.php';
    
	$organisationC=new organisationC();
    $listeorganisations=$organisationC->afficherorganisation(); 
    
?>
<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecyTech</title>



    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>


<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
        </div>
    </div>


    <!-- page wrap
    ================================================== -->
    <div id="page" class="s-pagewrap">


        <!-- # site header 
        ================================================== -->
        <?php include 'header.php'; ?>
        <div class="main">

        <div >
        <table >
                 <tr>
                        <th></th>
                        <th>ID</th>
                     <th >name</th>
                     <th >details</th>
                     <th >adress</th>
                     <th >Image</th>
                     <th>Actions</th>

                     <!--<td colspan="2" style="color: white; text-align: center;">Actions</td>-->
                 </tr>
                 <?php
                 foreach($listeorganisations as $organisation){
                     ?>
                     <tr>
                     <td ></td>
                     <td ><?php echo $organisation['id']; ?></td>
				<td ><?php echo $organisation['name']; ?></td>
                <td ><?php echo $organisation['details']; ?></td>
				<td ><?php echo $organisation['adress']; ?></td>
                <?php echo "<td><img src='../Admin/upload/{$organisation['image']}' width='50'></td>";
                                    echo "<td>";
                                    ?>
              
					  <style>
					  img{
						width: 90px;
                        height:	90px;					
					  }
					  
					  </style>
					  
					  </td>		
			      </tr>
                <?php
                 }
                 ?>

                </table>
        </div>
                </div>

        <?php include 'footer.php'; ?>

          <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>