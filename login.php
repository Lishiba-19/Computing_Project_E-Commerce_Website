<?php
include './TDHeader.php';
include './config.php';
include './Includes/Functions.php'; 

if (isset($_POST["submit"])) {

    $id = $_POST['Username'];
    $pass = $_POST['pass'];
 
    $uidExists = uidExits($conn, $id);
    
    $query = "SELECT * FROM customers WHERE Username = '$id' AND pass = '$pass';";
    $result=mysqli_query($conn, $query);
    $count= mysqli_num_rows($result);

if(empty($id) || empty($pass)){
    echo '<span class="msg2">Please enter all fields.</span>';
}   
elseif($count > 0){
    session_start();
    $_SESSION["useruid"] = $uidExists["Username"];
    header("location: ./index.php");
    exit();
}

else{
    header("location: ./login.php?error=wronglogin");
    exit();
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <header class="Head">
    </header>
   
</head>

<body>

<div class="log_sign">
<div class="SHeader">
<form action="" method="POST">
        <h2>Log-In</h2>
    </div>
    <div class="textbox">
    <input type = "text" name="Username" placeholder="Username"><br/><br/>
    </div>

    <div class="textbox">
    <input type = "password" name="pass" placeholder="Password"><br/><br/>
    </div>

    <div class="log-sign-btn">
        <button type="submit" name="submit">Log-In</button>

        <a href="./signin.php">No Account?</a>
    <a href="./Admin_Login.php">Admin</a>
    </div>
    
   
</div>
<?php

    if (isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<span class='msg2'>Enter all fields.</span>";
        }

        elseif($_GET["error"] == "wronglogin"){
            echo "<span class='msg2'>Username does not match with the password.</span>";

        }
    
}


    ?>
     </form>

</body>

<?php
include './TDFooter.php';

?>
</html>