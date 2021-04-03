<?php

require('config.php');
unset($_SESSION['email']);
$error = array("common"=>"", "name"=>"", "email"=>"", "mobile"=>"", "pass"=>"", "userType"=>"");
$er=0;
  if(isset($_POST['signup'])){
    $name = trim($_POST['name']);
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    if(isset($_POST['userType'])){
      $userType = $_POST['userType'];
    }
    else{
      $userType="";
    }

    if(empty($name) || empty($email) || empty($mobile) || empty($pass) || empty($userType)){
      $error['common'] = 'Please Fill all the Fields';
      $er = 1;
    }
    if (!preg_match('/^[a-zA-Z\s]+$/',$name)){
        $error['name'] = 'Name should contain only letters and spaces';
      $er = 1;
    }
    if (!preg_match('/^[0-9]{10}$/',$mobile)){
        $error['mobile'] = 'Mobile No. should be 10 digits';
      $er = 1;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error['email'] = 'Email ID is invalid';
      $er = 1;
    }
    if (!preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[0-9]).*$#", $pass)){
      $error['pass'] = 'Password should contain atleast 1 alphabet and 1 number';
      $er = 1;
    }
    if (strlen($pass)<6){
      $error['pass'] = 'Password should have atleast 6 characters';
      $er = 1;
    }
    if($userType==""){
      $error['userType'] = 'Type of User has to be Chosen';
      $er = 1;
    }
    $e1 = "SELECT * FROM passenger WHERE email='$email'";
    $e2 = "SELECT * FROM serviceCenter WHERE email='$email'";
    $result_email1 = $conn-> query($e1);
    $result_email2 = $conn-> query($e2);
    if (($result_email1-> num_rows > 0) || ($result_email2-> num_rows > 0)){
      $error['email'] = 'Email ID Already Exists';
      $er = 1;
    }
    if($er==0){
      $pass = str_rot13($pass);
      if($userType=="passenger"){
        $sql = "INSERT INTO passenger (name, email, mobile, pass) VALUES ('$name', '$email', '$mobile', '$pass')";
        if($conn->query($sql)==TRUE){
          $_SESSION['email'] = $email;
          header('Location: passenger.php');
        }
        else{
          echo "<h2 style='text-align: center; color: red;'>Could Not Add Passenger. Please Try Again</h2>";
        }
      }
      else{
        $sql = "INSERT INTO serviceCenter (name, email, mobile, pass) VALUES ('$name', '$email', '$mobile', '$pass')";
        if($conn->query($sql)==TRUE){
          $_SESSION['email'] = $email;
          header('Location: address.php');
        }
        else{
          echo "<h2 style='text-align: center; color: red;'>Could Not Add Service Center. Please Try Again</h2>";
        }
      }
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <style type="text/css">
    .wrapper {
        width: 100%;
        align-items: stretch;
        overflow: auto;
    }

    form{
    margin-top:80px;
    }

    .img-side{
    margin-top: 100px;
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
        margin: 5px -12px;
      }

    .input-group label{
      font-weight: 500;
    }
    .error{
      font-size: 14px;
      color: red;
    }

    .form-control:focus {
      border-color: #ABCDEF !important;
      box-shadow: 0 0 5px rgba(171,205,239,1) !important;
      font-size: 14px;
      font-weight: 500;
      color:#434343;
    }

    input::placeholder  { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #434343; /* Firefox */
    }

    .selectdiv select{
      width: 400px;
      height: 48px;
      background-color: #ffffff;
      font-size: 14px;
      font-weight: 500;
      color: #434343;
      border-radius: 5px;
      border: 1px solid #d6d6d6;
      padding: 6px 12px; 
      margin-top: 2rem;

    }

    .selectdiv{
      position: relative;
    }

    .selectdiv:after {
        content: '\f078';
        font: normal normal normal 15px/1 FontAwesome;
        color: #737b83;
        right: 11px;
        top: 22px;
        height: 34px;
        padding: 15px 0px 0px 8px;
        position: absolute;
        pointer-events: none;
    }

    /* IE11 hide native button (thanks Matt!) */
    .selectdiv select{
    -webkit-appearance: none;
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

    .radioname{
      color: #5d4a41;font-size: 15px;padding: 0 5px;
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
    width: 95%;
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

    .radioname{
      font-size: 12px;
    }
    input[type=radio] {
        margin: 2px -12px;
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


      .logdet{
        font-size: 25px;
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
              <!-- <div  class="logdet">Register</div> -->
              <div class="form-group">
                <span class="error"><?php echo $error['common']; ?></span>
                 <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                 <span class="error"><?php echo $error['name']; ?></span>   
              </div>   
          
              <div class="form-group">
                 <input type="text" class="form-control" id="email" name="email" placeholder="Your Email">
                 <span class="error"><?php echo $error['email']; ?></span>
              </div>  

               <div class="form-group">
                 <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile Number">
                 <span class="error"><?php echo $error['mobile']; ?></span>
              </div>

              <div class="form-group">
                 <input type="password" class="form-control" id="pass" name="pass" placeholder="Your Password">
                 <span class="error"><?php echo $error['pass']; ?></span>
              </div>

                <div class="input-group">
                    <div class="form-check col-6">
                    <input class="form-check-input" type="radio" name="userType" id="flexRadioDefault1" value="passenger">
                    <label for="remember" class="form-check-label radioname"
                    >Raahi</label>
                  </div>
                   <div class="form-check col-6">
                    <input class="form-check-input" type="radio" name="userType" id="flexRadioDefault1" value="serviceCenter">
                    <label for="remember" class="form-check-label radioname" 

                    >Service Provider</label>
                  </div>
                  <span class="error"><?php echo $error['userType']; ?></span>
                </div>

              
              <div class=" form-group d-flex justify-content-center" id="btn">
               <button type="submit" name="signup" class="btn btn-block">Sign Up</button>
              </div>
              <p class="foot">Already have an account?<a href="login.php" style="color: #ce907e;padding-left: 3px;text-decoration-line: underline;">Sign In</a></p>
            </form>
          </div>
        </div>
       <div class="col-lg-6 p-0">
          <div class="img-side">
          <img src="images/car3.jpg" class="img-responsive fit-image">
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