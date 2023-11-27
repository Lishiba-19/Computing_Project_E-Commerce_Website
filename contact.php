<?php
include_once './TDHeader.php';

//Send enquiry message to the company database
if (isset($_POST['submit'])) {
    $Fname = $_POST['Fname'];
    $mailFrom = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    require_once './config.php';
    require_once './Includes/Functions.php';

    createMessage($conn, $Fname, $mailFrom, $subject ,$message);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tidy Mulo's Official</title>
    
</head>

<body>
<div class="contact">
    <form class="contact-form" action="" method="POST">
    <p>SEND YOUR ENQUIRY.</p>
       <input type="text" name="Fname" placeholder="Full name" required> <br><br>
       <input type="text" name="mail" placeholder="Your e-mail" required><br><br>
       <input type="text" name="subject" placeholder="Subject" required><br><br>
       <textarea name="message" placeholder="Message" required></textarea><br><br>
       <button type="submit" name="submit">SEND</button>
    </form>

    <?php

if (isset($_GET["error"])){
    if($_GET["error"] == "none"){
        echo "<p class='msg2'>Message Sent!</p>";
    }
}
    ?>

</body>

<?php
include_once './TDFooter.php';
?>
</html>