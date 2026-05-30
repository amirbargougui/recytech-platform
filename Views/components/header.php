<header class="header">

   <section class="flex">
            <a class="logo" href="../views" style="scale :130%">
                  <img src="../front/images/logo.svg" alt="RecyTech.">  
            </a>       
      <nav class="navbar">
         
         <?php
  // Check if the cookie is present
  if(isset($_COOKIE['Admin'])) {
    // If the cookie is present, render the <a> tag
    echo '<a href="add_product.php">add product</a>
    <!--<a href="orders.php">orders</a> -->';
  }
?>
          <!--<a href="view_products.php">Shop</a>-->
         
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="shopping_cart.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>
   </section>

</header>