<?php

require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);
if($result->num_rows == 1){
  while($row=$result->fetch_assoc()){
    $name = $row['name'];
    $mobile = $row['contact'];
    $address = $row['address'];
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

    <link rel="stylesheet" type="text/css" href="css/orderdetail.css">

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


    <title>Order Detail Page</title>

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
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
               <h3 class="text-center">Order History</h3><br><br>
                  <div class="row m-0 product-page-display justify-content-center" >
                          <!-- Single Product Item Start -->
                          <?php 
                          
                          $sql = "SELECT * FROM transactions WHERE pemail='$email' ORDER BY status ASC";
                          $result = $conn->query($sql);
                          if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){

                          ?>
                        <div class="card">
                            <div class="card-body">
                              <?php
                                $scEmail = $row['scemail'];
                                $sql2 = "SELECT * FROM service WHERE email='$scEmail'";
                                $result2 = $conn->query($sql2);
                                if($result2->num_rows>0){
                                  while($row2 = $result2->fetch_assoc()){
                              ?>
                              <h4 class="text-align-center card-title"> Service Provider Details</h4><br>
                              <h5 class="card-title">Name: <span><?php $name2 = $row2['name']; echo $name2; ?></span></h5>
                              <h5 class="card-title">Email: <span><?php $email2 = $row2['email']; echo $email2; ?></span></h5>
                              <h5 class="card-title">Location: <span><?php $address2 = $row2['address']; echo $address2; ?></span></h5>
                              <h5 class="card-title">Mobile No.: <span><?php $mobile2 = $row2['contact']; echo $mobile2; }} ?></span></h5>
                              <h5 class="card-title">Room Chosen: <span>
                              <?php $roomName = $row['roomName'];
                              echo $roomName;
                              ?>  </span></h5>
                              
                            
                              <div class="d-flex justify-content-between">
                              <div class="card-price">Rs. <?php echo $row['roomPrice']; $roomPrice = $row['roomPrice']; ?></div>
                              <div class="status"><?php $status = strtoupper($row['status']);
                              echo $status; ?></div>
                              </div>
                              <?php if($status=="ACCEPTED"){ ?>
                            
                              <a href="#" class="btn buy-btn" style="margin-top: 10px;" data-toggle="modal" data-target="#exampleModalCenter">View Receipt</a>
                            
                            <?php } ?>

                            </div>
                          </div>
                               
            </div>

        


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-full-width modal-dialog-centered" role="document">
    <div class="modal-content modal-content-full-width ">
      <div class="modal-header modal-header-full-width text-center">
        <h5 class="modal-title" id="class-title ">RECEIPT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <div class="row">
        <div class="col-lg-4 col-md-4">
        <div class="heading text-center">User</div>
          <div class="row justify-content-center">
        
            <div class="modal-box">
              <div class="service-title">Name: <span><?php echo $name; ?></span></div>
              <div class="service-title">Contact Info: <span><?php echo $mobile; ?></span></div>
              <div class="service-title ">Email: <span><?php echo $email; ?></span></div> 
            </div>

          </div>
        </div>
        <div class="col-lg-4 col-md-4">
        <div class="heading text-center">Common</div>
          <div class="row justify-content-center">
        
            <div class="modal-box">
              <div class="service-title">Room Chosen: <span><?php echo $roomName; ?></span></div>
              <div class="service-title">Price: Rs. <?php echo $roomPrice; ?><span></span></div>
              <div class="service-title">Arrivial time: <span><?php echo $row['arrtime']; ?></span></div>
            </div>

          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="heading text-center">Accomodation</div>
          <div class="row justify-content-center">
            
            <div class="modal-box">
            <div class="service-title ">Accomodation Name: <span><?php echo $name2; ?></span></div>
            <div class="service-title">Contact Info: <span><?php echo $mobile2; ?></span></div>
            <div class="service-title ">Email: <span><?php echo $email2; ?></span></div> 
            <div class="service-title ">Location: <span><?php echo $address2; ?></span></div>
            
          </div>
        </div>
        </div>
        </div>
      </div>
      <div class="modal-footer modal-footer-full-width ">
        <button type="button" class="btn btn-secondary" onclick="window.print()">Print</button>
        <a href="paymentpage.php?price=<?php echo $row['roomPrice']; ?>"><button type="button" class="btn buy-btn">Checkout</button></a>
      </div>
    </div>
  </div>
</div>


</div>

<?php }} ?>

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
