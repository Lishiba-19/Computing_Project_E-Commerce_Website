<?php

if (isset($_POST['submit'])) {
    $Fname = $_POST['Fname'];
    $mailFrom = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    require_once './DBHandler.php';
    require_once './Functions.php';

    createMessage($connect, $Fname, $mailFrom, $subject ,$message);

}

//$sql = "Insert into contactinfo (contactid, fullname, email, message),
//values('$Fname', '$mailfrom', '$subject', '$message')";
//$result = mysqli_query($connect, $sql);
  //  header("Location: ./Contact.php?mailsent");