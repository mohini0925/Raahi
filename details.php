<?php

require('config.php');
if(!isset($_SESSION['email'])){
  header('Location: login.php');
  exit;
}
$er=0;
$err = $pErr = "";

$email = $_SESSION['email'];
if(isset($_POST['addDetails'])){
  $type = $_POST['type'];
  $description = $_POST['description'];
  $address = $_POST['address'];

  $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["serviceImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["serviceImage"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $pErr = "File is not an image.<br>";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      $pErr = "Image with the same name already exists.<br>";
      $uploadOk = 0;
    }

    if ($_FILES["serviceImage"]["size"] > 10485760) {
      $pErr = "Image cannot be more than 10 MB.<br>";
      $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      $pErr = "Only JPG, JPEG, PNG files are allowed.<br>";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["serviceImage"]["tmp_name"], $target_file)) {
        
      } else {
        
      }
    }

    $image = htmlspecialchars( basename( $_FILES["serviceImage"]["name"]));

    // image code ends

    if($type=="0"){
      $er=1;
      $err = "Please Select the Type of your Service";
    }

    if($uploadOk!=0  && $er==0){
      $searchTerm = $address;

      $buildQuery = http_build_query([
        'access_key' => 'f3cf897892df57307c368f33bcb17d82',
        'query' => $searchTerm
      ]);
      
      $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $buildQuery));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $responseData = curl_exec($ch);
      curl_close($ch);
      
      $resultData = json_decode($responseData, true);
      
      $latitude = $resultData["data"]["0"]["latitude"];
      $longitude = $resultData["data"]["0"]["longitude"];

      $sql = "UPDATE service SET address='$address', latitude='$latitude', longitude='$longitude', description='$description', image='$image', type='$type' WHERE email='$email'";
      if($conn->query($sql)===TRUE){
        header('Location: admin.php');
        exit;
      }
      else{
        $err = "Deatils Could Not be Added";
      }
    }
    else{
      $err = "Error in Uploading Image or Choosing Type of Service";
    }
}


?>




<!DOCTYPE html>
<html>
<head>
    <title>Details</title>
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
    display: flex;
    width: 100%;
    align-items: stretch;
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

  .form-control-new{
  width: 160px;
  height: 48px;
  background-color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  color: #434343;
  border-radius: 5px;
  border: 1px solid #d6d6d6;
  padding: 6px 12px; 
}

.end-time{
  margin-left: 40px;
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

  .logo{
    margin-bottom: 20px;
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
  width: 100%;
  object-fit: cover;
  height: auto; /* only if you want fixed height */
  }

  h6.statement{
    font-size: 16px;
    text-align: center;
    font-weight: 500;
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
  .error{
      font-size: 14px;
      color: red;
      text-align: center;
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

  .custom-file-label {
      position: absolute;
      right: 0;
      left: 0;
      margin-top: -20px;
      top:unset;
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

  .form-control-new{
  width: 90px;
  height: 35px;
  background-color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  color: #434343;
  border-radius: 5px;
  border: 1px solid #d6d6d6;
  padding: 6px 12px; 
}

.end-time{
  margin-left: 45px;
}

  .custom-file-label {
      position: absolute;
      right: 0;
      left: 0;
      margin-top: -20px;
      top:  unset;
  }

  .selectdiv select{
    width: 260px;
    height: 35px;
    font-size: 12px;
    font-weight: 500;
    color: #434343;}

  .selectdiv:after {
      font: normal normal normal 12px/1 FontAwesome;
      color: #737b83;
      top:16px;
      height: 34px;
      padding: 15px 0px 0px 8px;
      position: absolute;
      pointer-events: none;
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
         <!--  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#a25d4a" fill-opacity="0.8" d="M0,256L60,213.3C120,171,240,85,360,58.7C480,32,600,64,720,112C840,160,960,224,1080,218.7C1200,213,1320,139,1380,101.3L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg> -->
          <div class="row m-0 justify-content-center">
            <form data-aos="zoom-in" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
             <div class="row justify-content-center logo">
              <img src="images/logo.png" width="300px">
              </div>
              <h6 class="statement"><i>Add Details of Your Service <br>So Travellers can Recognize Your Services!</i><br><span class="error"><?php echo $err; ?></span></h6>
              <div class="selectdiv">  
                
                  <select name="type" id="type" required>
                    <option value="0">Select Your Service</option>
                    <option value="Accomodation">Accomodation</option>
                    <option value="Refreshment">Refreshment</option>
                    <option value="Hospital">Hospital</option>
                    <option value="Garage">Garage</option>
                  </select>
                </div> 
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" placeholder="Description of your Service..." rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="address" placeholder="Complete Address of your Service..." rows="3" required></textarea>
              </div>
             
             <div class="form-group">
               <label for="exampleFormControlTextarea1">Upload Image</label><br>
               <span class="error"><?php echo $pErr; ?></span>
              <input type="file"  name="serviceImage" id="customFile" required>
              <label class="custom-file-label" for="customFile">Choose file</label>
             </div>

            <div class="form-group ">
              
              <div class="row m-0">
              <div class="col-6 p-0">
                <label for="exampleFormControlTextarea1">Start Time</label>
                <input class="form-control-new" type="time" value="13:45:00" id="example-time-input">
              </div>
              <div class="col-6 p-0">
                <label for="exampleFormControlTextarea1" class="end-time">End Time</label><br>
                <input class="form-control-new float-right"  type="time" value="13:45:00" id="example-time-input">
              </div>
              </div>
            </div>


              <br>
              <div class=" form-group d-flex justify-content-center" id="btn">
               <button type="submit" name="addDetails" class="btn btn-block">Add Details</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 p-0">
          <img src="images/Address-pana.png" class="img-responsive fit-image">
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


          $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });


        </script>


</body>

</html>