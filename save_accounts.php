<?php

include('conn.php');

if($_SERVER['REQUEST_METHOD']=="POST"){
    $account_id = $_POST['companyId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['phone'];
    $date = $_POST['date'];

    $sql = "INSERT INTO account_details (account_id,name,email,gender,contact,date) VALUES ('$account_id','$name','$email','$gender','$contact','$date')";

    $result = $conn->query($sql);
    $conn->close();
}

header("LOCATION:show.php");
exit;

?>