<?php

require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}
$name = $contact = "";
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $name = $row['name'];
        $contact = $row['contact'];
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/profile.css">

     <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <a href="https://icons8.com/icon/15817/up-arrow"></a>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" href="css/easyzoom.css">


    <title>Profile Page</title>

</head>
<body>

<div id="wrapper">
  
    
    <div id="pre-loader" class="loader-container">
            <div id="loader">
               <img src="images/loader.gif">
            </div>
    </div>

    <div>
    <nav class="navbar navbar-expand-md bg-dark fixed-nav main-nav">
        <span href="home.php" class="navbar-brand"><img src="images/logo.png" height="50px" ></span>

        <button type="button" id="ChangeToggle" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <div id="navbar-hamburger"><i class="fa fa-bars"></i></div>
            <div id="navbar-close" class="hidden"><i class="fa fa-times"></i></div>
        </button>



        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ml-auto">
                <a href="amusement.php" class="nav-item nav-link active">Amusement</a>
                <a href="servicepage.php" class="nav-item nav-link">Services</a>
                <a href="about.html" class="nav-item nav-link">About Us</a>
             <div class="dropdown show">
              <a class="nav-item nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/usernew.png" width="25px">
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="orderdetail.php">Booking</a>
                <a class="dropdown-item" href="login.php">Logout</a>
              </div>
            </div>      
            </div>

        </div>
    </nav>

    <div class="container-fluid product-main-display">
        <div class="col-xs-12 col-sm-12 col-md-12 p-3">
        <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
               <h3 class="mb-3 text-center">Profile</h3>
                       <div class="row product-page-display justify-content-center mt-3" >
                          
          
            <form action="updateProfilePassenger.php" method="POST">
               
                    <div class="form-group">
                        <label for="fullName">Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="<?php echo $name; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" id="name" class="form-control" name="email" value="<?php echo $email; ?>" disabled required/>
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Mobile No.</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required/>
                    </div>
                <div class="text-center">
                <button type="submit" class="btn buy-btn" name="update">Update Profile</button>
                </div>
                </div>
                    
            </form>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
        <h3 class="text-center service-text">Reviews to Service Providers</h3>
        <div class="row m-0 product-page-display justify-content-center mt-3 mb-3">
            <div class="media flex-column comment">
                <?php 
            $sql = "SELECT * FROM review WHERE Pemail='$email'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){        
                    ?>
                    <div class="media-body media-body-inset-1"><br>
                        <?php
                            $scEmail = $row['SCemail'];
                            $sql2 = "SELECT * FROM service WHERE email='$scEmail'";
                            $result2 = $conn->query($sql2);
                            if($result2->num_rows>0){
                                while($row2=$result2->fetch_assoc()){
                        ?>
                                <h6><?php echo $row2['name']; ?></h6><span class="text-gray"></span><?php }} ?>
                    <div class="blog-post-time">
                        <time datetime="2018-04-24">Rating: <?php echo $row['rating']; ?>/5</time>
                    </div>
                        <p><?php echo $row['review']; ?></p>
                    </div>
                    <?php }}
            else{
                echo "<h3>No Reviews have been Added by You...</h3>";
            } ?>
            </div>   
            </div>
        </div>
        </div>
    </div>
    
    

</div>



    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Aos JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



    <script type="text/javascript">   
        jQuery(window).on('load', function(){ // makes sure the whole site is loaded
         jQuery('#pre-loader').delay(1200).fadeOut(); // will fade out the white DIV that covers the website.
         });

         $(function() {
            $('#ChangeToggle').click(function() {
            $('#navbar-hamburger').toggleClass('hidden');
            $('#navbar-close').toggleClass('hidden');  
           });
          });  

  $(document).ready(function(){
     AOS.init();
   });

   </script>

</body>
</html>


    
