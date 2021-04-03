<?php
require('config.php');
if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['deleteRoom'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id='$id'";
    if($conn->query($sql)===TRUE){
        header('Location: admin.php');
    }
    else{
        echo "Room Could Not be Deleted. Please go Back.";
    }
}

?>
