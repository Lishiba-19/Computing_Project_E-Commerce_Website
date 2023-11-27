<?php
include './TDHeader.php';

include './config.php';
include './Includes/Functions.php'; 

//admin authentication and login
if (isset($_POST["submit2"])) {

    $id = $_POST['Username'];
    $pass = $_POST['pass'];

    function AidExits($conn, $id) {
        $sql = "SELECT * FROM `admin` WHERE Username = ?;";
        $stmt = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt, $sql)){
  
    header("Location: ./signin.php?error=stmtfailed"); 
    exit();
 }
 mysqli_stmt_bind_param($stmt, "s", $id);
 mysqli_stmt_execute($stmt);

 $resultdata = mysqli_stmt_get_result($stmt);

 if ($row = mysqli_fetch_assoc($resultdata)){

    return $row;

 }

 else {
     $result = false;
     return $result;
 }

 mysqli_stmt_close($stmt);
    }

    
 
    $AidExists = AidExits($conn, $id);
    
    $query = "SELECT * FROM `admin` WHERE Username = '$id' AND pass = '$pass';";
    $result=mysqli_query($conn, $query);
    $count= mysqli_num_rows($result);

if(empty($id) || empty($pass)){
    echo "<span class='msg2'>Please enter all fields.</span>";
}   
elseif($count > 0){
    session_start();
    $_SESSION["Admin"] = $AidExists["Username"];
    header("location: ./index.php");
    exit();
}


else{
    header("location: ./Admin_Login.php?error=wronglogin");
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
        <h2>Admin Log-In</h2>
    </div>
    <div class="textbox">
    <input type = "text" name="Username" placeholder="Username"><br/><br/>
    </div>

    <div class="textbox">
    <input type = "password" name="pass" placeholder="Password"><br/><br/>
    </div>

    <div class="log-sign-btn">
        <button type="submit" name="submit2">Log-In</button>
        <a href="./login.php">Go Back</a>
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