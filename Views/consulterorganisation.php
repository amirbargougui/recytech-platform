

<?php

session_start();
include_once '../Controller/organisationC.php';
    //include '../config.php';
	$organisationC=new organisationC();
    
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
    <link rel="stylesheet" href="css/pagination.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    </head>

    <body id="top" class="ss-show">
        <div id="preloader" style="display: none;">
            <div id="loader">
            </div>
        </div>

        <!-- # site header 
        ================================================== -->

        <?php include 'header.php'; ?>


       
        <!-- # site-content
        ================================================== -->
        <!--Causes Start-->
        <section class="wf100 p80 events">
        <section id="pricing" class="s-pricing target-section">
                <div class="row s-pricing__content">
                    <div class="column lg-8 md-12 s-pricing__plans">
                        <div class="row plans block-lg-one-half block-tab-whole">
                            
                        <?php
                         $dsn = 'mysql:host=localhost;dbname=projet';
                         $username = 'root';
                         $password = '';
                         $options = array(
                         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                           );

                       try {
                       $db = new PDO($dsn, $username, $password, $options);
                        } catch (PDOException $e) {
                       echo "Connection failed: " . $e->getMessage();
                        }

                        $results_per_page = 2;

                        $sql = 'SELECT COUNT(*) as count FROM organisation';
                        $stmt = $db->query($sql);
                        $number_of_results = $stmt->fetch()['count'];

                        $number_of_pages = ceil($number_of_results/$results_per_page);

                       // determine which page number visitor is currently on
                     if (!isset($_GET['page'])) {
                      $page = 1;
                      } else {
                      $page = $_GET['page'];
                      }

                     $this_page_first_result = ($page-1)*$results_per_page; //index org

                     // retrieve selected results from database and display them on page
                    $sql = 'SELECT * FROM organisation LIMIT ' . $this_page_first_result . ',' . $results_per_page;
                    $stmt = $db->query($sql);

                while ($row = $stmt->fetch()) {

    echo '<div class="column item-plan item-plan--popular">
        <div class="item-plan__block"> 
            <div class="item-plan__top-part">
                <td> <img src="../Admin/upload/'.$row['image'].'" > </td>
                <td>
                    <br/>
                    <h3 class="item-plan__title">'.$row['name'].'</h3>
                </div>
                <div class="item-plan__bottom-part">
                    <ul class="item-plan__features">
                        <li><span>Detail :'.$row['details'].'</span></li>
                        <li><span>Adresse :'. $row['adress'].'</span></li>
                    </ul>
                    <a class="btn btn--primary u-fullwidth" href="donationform.php?id='. $row['id'].'">DONATE</a>
                </div>
            </div>
        </div>';
        
}
?>
<div class="pagination-option">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php 
            // display the links to the pages
            for ($page=1;$page<=$number_of_pages;$page++) {
                $getpage = "";
                if(isset($_GET['page'])) {
                    $getpage = $_GET['page'];
                }
                if($page==$getpage) {
                    echo '<a class="active" href="consulterorganisation.php?page=' . $page . '"  >' . $page . '</a> ';
                } else {
                    echo '<a href="consulterorganisation.php?page=' . $page . '" >' . $page . '</a>';
                }
            }
            ?>    
        </ul>
    </nav>
</div>

                        
                        
                    </div> <!-- end s-pricing__plans -->

                </div> <!-- end s-pricing__content -->
            </section> <!-- end pricing -->
         <!--Causes End--> 
        
      <!-- # site-footer
        ================================================== -->
        <?php include'footer.php' ?>


    <!--  JS Files Start  --> 
 <script src="js/jquery-3.3.1.min.js"></script> 
  <script src="js/jquery-migrate-1.4.1.min.js"></script> 
  <script src="js/popper.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/owl.carousel.min.js"></script> 
  <script src="js/jquery.prettyPhoto.js"></script> 
  <script src="js/isotope.min.js"></script> 
  <script src="js/custom.js"></script>

</body>
</html>
