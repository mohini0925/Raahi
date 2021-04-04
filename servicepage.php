<?php

require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}
$email = $_SESSION['email'];
$pos = "SELECT * FROM user WHERE email='$email'";
$res = $conn->query($pos);
if($res->num_rows>0){
  while($r=$res->fetch_assoc()){
    $lat1 = $r['latitude'];
    $long1 = $r['longitude'];
  }
}

$distanceArray = array();
$ratingArray = array();
$sql = "SELECT * FROM service";
$result = $conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $lat2 = $row['latitude'];
    $long2 = $row['longitude'];
    $em = $row['email'];
    $theta = $long2 - $long1;
    $dist=sin(deg2rad($lat2)) * sin(deg2rad($lat1)) + cos(deg2rad($lat2)) * cos(deg2rad($lat1)) * cos(deg2rad($theta));
    $miles = acos($dist);
    $miles = rad2deg($miles);
    $km = $miles*60*1.1515;
    $km = $km*1.609344;
    $km = substr($km, 0,4);
    $distanceArray[$em] = $km;
    $sql2 = "SELECT AVG(rating) AS avgRating FROM review WHERE SCemail='$em'";
    $result2=$conn->query($sql2);
    if($result2->num_rows>0){
      while($row2=$result2->fetch_assoc()){
        $ar = substr($row2['avgRating'], 0,3);
        $ratingArray[$em] = $ar;
      }
    }else{
      $ratingArray[$em] = 0;
    }
  }
}
asort($distanceArray);
asort($ratingArray);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/servicepage.css">

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


    <title>Services Page</title>

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
        <span href="#" class="navbar-brand"><img src="images/logo.png" height="50px" ></span>

        <button type="button" id="ChangeToggle" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <div id="navbar-hamburger"><i class="fa fa-bars"></i></div>
            <div id="navbar-close" class="hidden"><i class="fa fa-times"></i></div>
        </button>



        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ml-auto">
                <a href="index.html" class="nav-item nav-link active">Amusement</a>
                <a href="#" class="nav-item nav-link">Services</a>
                <a href="#" class="nav-item nav-link">About Us</a>
             <div class="dropdown show">
              <a class="nav-item nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/usernew.png" width="25px">
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">My Profile</a>
                <a class="dropdown-item" href="#">Booking</a>
                <a class="dropdown-item" href="#">Logout</a>
              </div>
            </div>      
            </div>

        </div>
    </nav>

    <div class="container-fluid product-main-display">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="row">
                            <form class="searchButton" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                              <input type="text" placeholder="Search" name="search">
                              <button type="submit" name="searchBtn"><i class="fa fa-search"></i></button>
                            </form>

                             <div class="dropdown filter2">
                              <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="servicepage.php?sort=distance">Sort by Distance</a>
                                <a class="dropdown-item" href="servicepage.php?sort=rating">Sort by Rating</a>
                              </div>
                            </div>

                            <div class="dropdown filter">
                              <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="servicepage.php?filter=Accomodation">Accomodation</a>
                                <a class="dropdown-item" href="servicepage.php?filter=Refreshment">Refreshment</a>
                                <a class="dropdown-item" href="servicepage.php?filter=Hospital">Hospital</a>
                                  <a class="dropdown-item" href="servicepage.php?filter=Garage">Garage</a>
                              </div>
                            </div>
                        </div><br><br>

                        <div class="row  m-0 product-page-display justify-content-center" >
                                <!-- Single Product Item Start -->
                              <?php

                                if(isset($_GET['sort'])){
                                  if($_GET['sort']=="distance"){
                                    foreach($distanceArray as $e => $dist){
                                      if($dist<15){
                                        $abc = "SELECT * FROM service WHERE email='$e'";
                                        $res = $conn->query($abc);
                                        if($res->num_rows==1){
                                          while($r=$res->fetch_assoc()){
                                            ?>

                                              <div class="card">
                                                <div class="fix-image">
                                                  <img src="uploads/<?php echo $r['image']; ?>" class="card-img-top" alt="...">
                                                </div> 
                                                <div class="card-body">
                                                  <h5 class="card-title"><?php echo $r['name']; ?></h5>
                                                  <h6 class="card-type"><?php echo $r['type']; ?></h6>

                                                  <div class="row m-0 pb-3">                                    
                                                    <div class="card-details "><i class="fa fa-map-marker" style="color: red;" aria-hidden="true"></i>
                                                      <span><?php echo $dist; ?> Km</span>
                                                    </div>

                                                    <div class="card-details ml-auto"><i class="fa fa-star" style="color: yellow;" aria-hidden="true"></i> <span><?php echo $ratingArray[$e]; ?></span></div>
                                                  </div>

                                                  <div class="card-time float-left">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo $r['time']; ?></span>
                                                  </div>

                                                  <div class="modal-btn">
                                                    <a href="servicedetail.php?id=<?php echo $r['id']; ?>" class="btn buy-btn">View Details</a>
                                                  </div>
                                                </div>
                                              </div>

                                            <?php
                                          }
                                        }
                                      }
                                    }
                                  }
                                  else if($_GET['sort']=="rating"){
                                    foreach($ratingArray as $e => $rating){
                                      if($dist<15){
                                        $abc = "SELECT * FROM service WHERE email='$e'";
                                        $res = $conn->query($abc);
                                        if($res->num_rows==1){
                                          while($r=$res->fetch_assoc()){
                                            ?>

                                              <div class="card">
                                                <div class="fix-image">
                                                  <img src="uploads/<?php echo $r['image']; ?>" class="card-img-top" alt="...">
                                                </div> 
                                                <div class="card-body">
                                                  <h5 class="card-title"><?php echo $r['name']; ?></h5>
                                                  <h6 class="card-type"><?php echo $r['type']; ?></h6>

                                                  <div class="row m-0 pb-3">                                    
                                                    <div class="card-details "><i class="fa fa-map-marker" style="color: red;" aria-hidden="true"></i>
                                                      <span><?php echo $distanceArray[$e]; ?> Km</span>
                                                    </div>

                                                    <div class="card-details ml-auto"><i class="fa fa-star" style="color: yellow;" aria-hidden="true"></i> <span><?php echo $rating; ?></span></div>
                                                  </div>

                                                  <div class="card-time float-left">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo $r['time']; ?></span>
                                                  </div>

                                                  <div class="modal-btn">
                                                    <a href="servicedetail.php?id=<?php echo $r['id']; ?>" class="btn buy-btn">View Details</a>
                                                  </div>
                                                </div>
                                              </div>

                                            <?php
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                                else if(isset($_GET['filter'])){
                                  $filter = $_GET['filter'];
                                  $sql = "SELECT * FROM service WHERE type='$filter'";
                                  $result = $conn->query($sql);
                                  if($result->num_rows > 0){
                                    while($row=$result->fetch_assoc()){
                                      $e = $row['email'];
                                      if($distanceArray[$e]<15){
                                      ?>

                                          <div class="card">
                                            <div class="fix-image">
                                              <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                                            </div> 
                                            <div class="card-body">
                                              <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                              <h6 class="card-type"><?php echo $row['type']; ?></h6>

                                              <div class="row m-0 pb-3">                                    
                                                <div class="card-details "><i class="fa fa-map-marker" style="color: red;" aria-hidden="true"></i>
                                                  <span><?php echo $distanceArray[$e]; ?> Km</span>
                                                </div>

                                                <div class="card-details ml-auto"><i class="fa fa-star" style="color: yellow;" aria-hidden="true"></i> <span><?php echo $ratingArray[$e]; ?></span></div>
                                              </div>

                                              <div class="card-time float-left">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo $row['time']; ?></span>
                                              </div>

                                              <div class="modal-btn">
                                                <a href="servicedetail.php?id=<?php echo $row['id']; ?>" class="btn buy-btn">View Details</a>
                                              </div>
                                            </div>
                                          </div>

                                      <?php
                                      }
                                    }
                                  }
                                }

                                else{
                                  if(isset($_POST['searchBtn'])){
                                    $search = $_POST['search'];
                                    $sql = "SELECT * FROM service WHERE name LIKE '%$search%'";
                                  }
                                  else{
                                    $sql = "SELECT * FROM service";
                                  }
                                  $result = $conn->query($sql);
                                  if($result->num_rows > 0){
                                    while($row=$result->fetch_assoc()){
                                      $e = $row['email'];
                                      if($distanceArray[$e]<15){
                                      ?>

                                          <div class="card">
                                            <div class="fix-image">
                                              <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                                            </div> 
                                            <div class="card-body">
                                              <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                              <h6 class="card-type"><?php echo $row['type']; ?></h6>

                                              <div class="row m-0 pb-3">                                    
                                                <div class="card-details "><i class="fa fa-map-marker" style="color: red;" aria-hidden="true"></i>
                                                  <span><?php echo $distanceArray[$e]; ?> Km</span>
                                                </div>

                                                <div class="card-details ml-auto"><i class="fa fa-star" style="color: yellow;" aria-hidden="true"></i> <span><?php echo $ratingArray[$e]; ?></span></div>
                                              </div>

                                              <div class="card-time float-left">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo $row['time']; ?></span>
                                              </div>

                                              <div class="modal-btn">
                                                <a href="servicedetail.php?id=<?php echo $row['id']; ?>" class="btn buy-btn">View Details</a>
                                              </div>
                                            </div>
                                          </div>

                                      <?php
                                      }
                                    }
                                  }
                                  
                                }
                              
                              ?>
                                     
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


    
