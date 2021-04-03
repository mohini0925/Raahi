<?php
require('config.php');
if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['editRoom'])){
    $name = $_POST['roomNameEdit'];
    $price = $_POST['roomPriceEdit'];
    $id = $_GET['id'];
    $sql = "UPDATE rooms SET roomName='$name', roomPrice='$price' WHERE id='$id'";
    if($conn->query($sql)===TRUE){
        header('Location: admin.php');
    }
    else{
        echo "Room Could Not be Edited. Please go Back.";
    }
}

?>
