<header class="s-header">

<div class="row s-header__inner">

    <div class="s-header__block">
        <div class="s-header__logo">
            <a class="logo" href="index.php">
                <img src="images/logo.svg" alt="Homepage">  
            </a>
        </div>

        <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
    </div> <!-- end s-header__block -->

    <nav class="s-header__nav">
        <ul>
            <li class="current"><a href="#intro" class="smoothscroll">Intro</a></li>
            <li><a href="#about" class="smoothscroll">About</a></li>
            <li><a href="#pricing" class="smoothscroll">Pricing</a></li>
            <li><a href="#download" class="smoothscroll">Blog</a></li>
            <li><a href="collection-schedule.php" class="smoothscroll">Add Schedule</a></li>
            <li><a href="refund_list.php" class="smoothscroll">Refund</a></li>


        </ul>
    </nav>




    <div class="s-header__cta">
        <?php if(!isset($_SESSION['client'])) { ?>
            <div class="s-header__cta">
  <a href="SignUp.php#subscribe" class="btn btn--stroke s-header__cta-btn" style="margin-right: 10px;">Sign Up</a>
  <a href="SignIn.php#sign" class="btn btn--stroke s-header__cta-btn">Sign In</a>
</div>

    <?php  }else{   ?>
    <div class="s-header__cta">
        <a href="MyProfile.php#testimonials" class="btn btn--stroke s-header__cta-btn" style="margin-right: 10px;"> My Profil</a>
        <a href="Deconnexion.php" class="btn btn--stroke s-header__cta-btn">Deconnexion</a>
    </div>

    <?php } ?>
    </div>

</div> <!-- end s-header__inner -->

</header> <!-- end s-header -->
