<?php

require('config.php');
$error = array("email"=>"");
$er=0;
  if(isset($_POST['submit'])){
    $email = $_POST['email'];
  if(empty($email)){
    $error['email'] = 'Please Enter an Email Address';
    $er = 1;
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error['email'] = 'Email ID is invalid';
    $er = 1;
  }
  if($er==0){
    $e1 = "SELECT * FROM user WHERE email='$email'";
    $result_email1 = $conn-> query($e1);
    $e2 = "SELECT * FROM service WHERE email='$email'";
    $result_email2 = $conn-> query($e2);
    $pass = "";
    if ($result_email1->num_rows == 1){
        while($row = $result_email1->fetch_assoc()) {
            $pass = str_rot13($row['pass']);
            $toEmail = $row['email'];
            $subject = "Password Recovery from Raahi";
            $body = "Greetings! The Password for your Account on Raahi is '$pass'. Kindly Login using this Password to continue using our Application and Make Sure to Remember your Password! :)";
            $headers = "From: marujay0203@gmail.com";
            if (mail($toEmail, $subject, $body, $headers)) {
                header('Location: login.php');
            } else {
                echo "Email sending failed...";
            }
        }
    }
    elseif($result_email2->num_rows == 1){
        while($row = $result_email2->fetch_assoc()) {
            $pass = str_rot13($row['pass']);
            $toEmail = $row['email'];
            $subject = "Password Recovery from Raahi";
            $body = "Greetings! The Password for your Account on Raahi is '$pass'. Kindly Login using this Password to continue using our Application and Make Sure to Remember your Password! :)";
            $headers = "From: marujay0203@gmail.com";
            if (mail($toEmail, $subject, $body, $headers)) {
                header('Location: login.php');
            } else {
                echo "Email sending failed...";
            }
        }
    }
    else{
        $error['email'] = 'Email ID does not Exist';
    }
  }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
     <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <a href="https://icons8.com/icon/16247/menu"></a>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
 
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        .img-side{
            margin-top: 100px;
        }

        form{
        margin-top:20px;
        }

        .form-group label{
        font-size: 1.5rem;
        font-weight: 500;
        }

        .form-control{
        width: 400px;
        height: 48px;
        background-color: #ffffff;
        font-size: 14px;
        font-weight: 500;
        color: #434343;
        border-radius: 5px;
        border: 1px solid #d6d6d6;
        padding: 6px 12px; 
        }

        .form-group{
        margin-top: 2rem;
        }
        .input-group{
        margin-top: 15px; 
        }
        input[type=radio] {
            margin: 3px -12px;
        }

        .input-group label{
        font-weight: 500;
        }

        .form-control:focus {
        border-color: #ABCDEF !important;
        box-shadow: 0 0 5px rgba(171,205,239,1) !important;
        font-size: 14px;
        font-weight: 500;
        color:#434343;
        }
        .error{
        font-size: 14px;
        color: red;
        }

        .logo{
        margin-bottom: 50px;
        }

        #btn{
        background-color: #e65952;
        border-radius: 5px;
        height: 48px;

        }
        .btn:hover{
        color: white;
        box-shadow:0 0 3px #e65952!important; 
        }

        .foot{
            text-align: center;    
            margin-top: 30px;
            letter-spacing: 0.6px;
            font-size: 15px;
            font-weight: 500;
        }

        .btn{
        color: white;
        font-size: 15px;
        font-weight: 500;
        }

        .fit-image{
        width: 99%;
        object-fit: cover;
        height: auto; /* only if you want fixed height */
        }

        @media (max-width: 990px) {
        form{
            margin-top:50px;
        }
        }

        @media (max-width: 500px) {
        .form-control{
        width: 260px;
        height: 35px;
        background-color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        color: #737999;
        }

        .img-side{
            margin-top: 10px;
        }   

        .logo img{
        width: 200px;
        }

        #btn{
        height: 40px;
        }

        .form-control:focus {
        
        font-size: 12px;
        font-weight: 500;
        color: #737999;
        }



        form{
            margin-top:50px;
        }

        }

        button:focus {outline:0 !important;}
    </style>

</head>
<body>
  <div class="wrapper">
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-lg-6  align-self-center p-0" >
          <div class="row m-0 justify-content-center">
            <form data-aos="zoom-in" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
             <div class="row justify-content-center logo">
              <img src="images/logo.png" width="300px">
              </div>
              
              <div class="form-group">
                  <h3 style="text-align: center;">Enter the Registered Email ID to<br> Receive the Password in your Mail!</h3><br>
                 <input type="text" class="form-control" id="name" name="email" placeholder="Your Email">
                 <span class="error"><?php echo $error['email']; ?></span>
              </div>  
              <div class=" form-group d-flex justify-content-center" id="btn">
               <button type="submit" name="submit" class="btn btn-block">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 p-0">
            <div class="img-side">
                <img src="images/car1.jpg" class="img-responsive fit-image">
            </div>
        </div>
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

        </script>
    
</body>
</html>