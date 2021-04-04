<?php 

require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}

$email = $_SESSION['email'];
if(isset($_POST['getlatlong'])){
  if(isset($_POST['latitude']) && isset($_POST['longitude'])){
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $searchQuery = $latitude.','.$longitude;

    $buildQuery = http_build_query([
      'access_key' => 'f3cf897892df57307c368f33bcb17d82',
      'query' => $searchQuery
    ]);
    $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/reverse', $buildQuery));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    $address = $result["data"]["0"]["label"];

      $sql = "SELECT * FROM user WHERE email='$email'";
      $result = $conn->query($sql);
      if($result->num_rows == 1){
        $sql1 = "UPDATE user SET latitude='$latitude', longitude='$longitude', address='$address' WHERE email='$email'";
        if($conn->query($sql1)){
          
        }
        else{
          echo "Could Not Update Location. Please Refresh the Page.";
        }
      }
      else{
        echo "Invalid User. Please Logout and Login with a User Account";
      }
  }
  else{
    echo "Could Not Update Location. Please Refresh the Page.";
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

    <link rel="stylesheet" type="text/css" href="css/homepage.css">

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


    <title>Home Page</title>

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

    <div class="container-lg">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/carousel-img.jpg" class="fit-image"
                     width="100%">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.pixabay.com/photo/2018/06/14/21/15/the-interior-of-the-3475656_1280.jpg" class="fit-image" width="100%">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.pixabay.com/photo/2016/02/19/11/40/coffee-shop-1209863_1280.jpg" class="fit-image" width="100%">
                </div>
            </div>
        </div>
    </div>


<div class="container-fluid screen-1">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 p-0 align-self-center" data-aos="fade-right">
      <div class="row m-0 justify-content-center">
        <div class="main-screen">
      <div class="main-text">Find Best Accomodation Near You</div>
      <div class="sub-text"> A list of accomodations of all types, suiting all budget is specially curated for you based on your location.</div>
      <div class="link-button">
        
          <button class="hire-mech">Explore</button>
        </div>
       </div>
      </div>
    </div>
     <div class="col-lg-6 col-md-6 p-0 image-screen" data-aos="fade-left">
       <img src="https://images.unsplash.com/photo-1543968332-f99478b1ebdc?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="img-responsive fit-image" >
     </div>
  </div>
</div>

<hr>

<div class="container-fluid screen-2">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 p-0 image-screen" data-aos="fade-right">
       <img src="https://images.unsplash.com/photo-1417353783325-14cb8f9ba1dd?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1051&q=80" class="img-responsive fit-image" >
     </div>
    <div class="col-lg-6 col-md-6 p-0 align-self-center" data-aos="fade-left">
      <div class="row m-0 justify-content-center">
      <div class="main-screen">
      <div class="main-text">Need Refreshment? No worry</div>
      <div class="sub-text">Here we give list of diffrent refereshment places to find Food , Beverages and Washroom facility while you travel by road.</div>
      <div class="link-button">
        
          <button class="hire-mech">Explore</button>
          
        </div>
       </div>
      </div>
    </div>
     
  </div>
</div>

<hr>

<div class="container-fluid screen-1">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 p-0 align-self-center" data-aos="fade-right">
      <div class="row m-0 justify-content-center">
        <div class="main-screen">
      <div class="main-text">Find Hospital Near You in Emergency</div>
      <div class="sub-text">At the time of any emergency, we provide you location of different hospitals around you.</div>
      <div class="link-button">
        
          <button class="hire-mech">Explore</button>
        </div>
       </div>
      </div>
    </div>
     <div class="col-lg-6 col-md-6 p-0 image-screen" data-aos="fade-left">
       <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1035&q=80" class="img-responsive fit-image" >
     </div>
  </div>
</div>

<hr>

<div class="container-fluid screen-2">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 p-0 image-screen" data-aos="fade-right">
       <img src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80" class="img-responsive fit-image" >
     </div>
    <div class="col-lg-6 col-md-6 p-0 align-self-center" data-aos="fade-left">
      <div class="row m-0 justify-content-center">
        <div class="main-screen">
      <div class="main-text">Vehicle Breakdown? we got you covered</div>
      <div class="sub-text">Here we give list of diffrent service center and mechanic to get to you in this type of situation.Also find nearby petrol pump. Contact or email them so they can reach to you.</div>
      <div class="link-button">
        
          <button class="hire-mech">Explore</button>
          
        </div>
       </div>
      </div>
    </div>
     
  </div>
</div>



<div class="container-fluid screen-2" data-aos="zoom-in">
  <div class="row m-0 covid-screen">
    <div class="col-lg-6 col-md-6 p-4">
      <div class="row m-0">
        <div class="col-lg-6 col-md-6 p-0">
          <div class="row justify-content-center">
          <img src="images/covid1.png" class="img-responsive rounded-circle fit-image">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 p-0">
          <div class="main-text1">Need Refreshment? No worry</div>
      <div class="sub-text1">Here we give list of diffrent refereshment places to find Food , Beverages and Washroom facility while you travel by road.</div>
      <div class="link-button">
        
          <button class="hire-mech1">Know More</button>
          
        </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 p-4">
      <div class="row m-0 justify-content-center">
        <div class="col-lg-6 col-md-6 p-0">
          <div class="row justify-content-center">
          <img src="images/covid3.png" class="img-responsive rounded-circle fit-image" >
        </div>
        </div>
        <div class="col-lg-6 col-md-6 p-0">
         <div class="main-text1">Need Refreshment? No worry</div>
      <div class="sub-text1">Here we give list of diffrent refereshment places to find Food , Beverages and Washroom facility while you travel by road.</div>
      <div class="link-button">
        
          <button class="hire-mech1">Know More</button>
          
        </div>
      </div>
    </div>
  </div>
</div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="latLongForm">
          <input type="number" name="latitude" id="latitude" value="" hidden step="0.0000001">
          <input type="number" name="longitude" id="longitude" value="" hidden step="0.0000001">
          <button type="submit" name="getlatlong" id="getlatlong" value="getlatlong"></button>
        </form>

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


<script>
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(showPosition);
      

    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }

  function showPosition(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
    document.getElementById('getlatlong').click();
  }

</script>
<?php 

  if($_SESSION['loc'] == 0){
    $_SESSION['loc'] = 1;
      echo "<script>
        var temp = confirm('Do You Allow your Location to be Recorded?');
        if(temp == true){
          getLocation();
        }
        else{
          alert('LOCATION NOT RECORDED');
        }
      </script>";
  }
      ?>
</body>
</html>


    
