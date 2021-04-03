<?php
require('config.php');
if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['edit'])){
        $nameEdit = $_POST['name'];
        $mobileEdit = $_POST['mobile'];
        $descriptionEdit = $_POST['description'];
        $timeEdit = $_POST['time'];
        
        $email = $_SESSION['email'];
        $edit = "UPDATE service SET name='$nameEdit', contact='$mobileEdit', description='$descriptionEdit', time='$timeEdit' WHERE email='$email'";
        if($conn->query($edit) === TRUE){
        header('Location: admin.php');
    }
    else{
        $hErr = "Profile Could Not be Updated!";
    }
}

?>