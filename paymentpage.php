<?php
require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}
$price = 0;
if(isset($_GET['price'])){
  $price = $_GET['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/paymentpage.css">

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

    <title>Payment Page</title>


</head>
<body>
  <div class="wrapper">
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-lg-6 p-0" >
          
          <div class="row m-0 justify-content-center">

            <img src="images/pay.jpg" class="img-responsive fit-image">
          </div>
        </div>

        <div class="col-lg-6 align-self-center p-0">
          <h3 class="payment-title text-center">Your Bill for Payment</h3>
          <div class="row m-0 justify-content-center">
            
            <div class="payment-box">
                        <div class="col-lg-12 service-box">
                                <div class="row m-0 justify-content-between">
               
                                  <div class="service-title">Sub Total: </div>
                                  <div class="service-price">Rs. <?php echo $price; ?></div>
                                
                                 </div>
                                 <div class="row m-0 justify-content-between">
                                   <div class="service-title">Taxes: </div>
                                     <div class="service-price"><?php $tax = $price*18/100; echo "Rs. " . $tax; ?></div>
                                 </div>
                                  <div class="row m-0 justify-content-between">
                          
                                  <div class="service-title">Total</div>
                                   <div class="service-price">Rs. <?php echo ($price+$tax); ?></div>
                                  
                                 </div>
                </div>
            </div>
            
            <div id="accordion">
              <h3 class="payment-title text-center">Select Payment Method</h3>
       <div class="card">
         <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><div class="pay2">
           Credit /Debit Cards <img src="https://js.stripe.com/v3/fingerprinted/img/mastercard-4d8844094130711885b5e41b28c9848f.svg"><img src="https://js.stripe.com/v3/fingerprinted/img/visa-365725566f9578a9589553aa9296d178.svg"><img src="https://js.stripe.com/v3/fingerprinted/img/amex-a49b82f46c5cd6a96a6e418a6ca1717c.svg"></div>
          </button>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <form action="final.html" method="post" id="payment-form">

      <div class="card-number">Card Number<br>
      <input type="text" name="card-number" id="card-number">

        </div>
      <br>

    <div class="card-holder" >Card Holder Name<br>
      
    <input type="text" name="card-holder"  id="card-holder">
      </div>

      <br>
      <div class="divide">

          <div class="month">Expiration Date<br>

          <input type="text" name="month" id="month" placeholder="  MM / YY" maxlength="4" size="4" />
          </div>
    

           <div class="cvv">CVV<br>
           <input type="text" name="cvv" id="cvv" placeholder="* * *">
           </div>
      
      </div>
      <br>
      <a href="final.html"><button class="button1">Confirm Payment</button></a><br>
      <p class="info"><i class="fa fa-lock" style="font-size:15px"></i>  Your card payment is encrypted</p>
      </form>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn  collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><div class="pay2">
           Paytm<img src="https://www.searchpng.com/wp-content/uploads/2019/02/Paytm-Logo-With-White-Border-PNG-image.png" style="width: 50px;"></div>
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <form action="final.html" method="post" id="payment-form">
    
        <div class="card-number">Mobile Number<br>
        <input type="text" name="mobile-number" id="mobile-number">
    
          </div>

        <a href="final.html"><button class="button1">Confirm Payment</button></a><br>

        </form>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            On Site
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          <a href="final.html"><button class="button1">Confirm Payment
          </button></a>
        </div>
      </div>
    </div>
  </div>

          </div>
        </div>



        <!-- End -->
      </div>
    </div>
  </div>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script type="text/javascript">
          AOS.init();
           $('.collapse').collapse()

        </script>


</body>

</html>