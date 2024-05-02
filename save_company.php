<?php

include('conn.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $date = $_POST['date'];

    $sql = "INSERT INTO accounts (name,date) VALUES ('$name','$date')";

    $result = $conn->query($sql);
    if($result==TRUE){
        echo "Record updated successfully";
    }
    else{
        echo "Unable to Updatedata".$conn->error;
    }
    $conn->close();
}

header("LOCATION:frm_html.php");
exit;
?>