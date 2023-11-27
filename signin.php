<?php
include './TDHeader.php';
include './config.php';
include './Includes/Functions.php';

if (isset($_POST["submit"])) {

    $id =$_POST['Username'];
    $pass =$_POST['pass'];
    $repass =$_POST['repass'];


    if (emptyInputSignup($id, $pass, $repass) !== false){
        header("Location: ./signin.php?error=emptyinput"); 
       exit();
    }

    
    if (InvalidUserId($id) !== false){
        header("Location: ./signin.php?error=InvalidId"); 
       exit();
    }

    
    if (PwdMatch($pass, $repass) !== false){
        header("Location: ./signin.php?error=PasswordsDontMatch"); 
       exit();
    }

    
    if (uidExits($conn, $id) !== false){
        header("Location: ./signin.php?error=UsernameTaken"); 
       exit();
    }

    createuser($conn, $id, $pass);



}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>

    <header class="Head">
    </header>
   
</head>

<body>


<div class="log_sign">
<form action="" method="POST">
    <div class="SHeader">
        <h2>Sign-Up</h2>
    </div>

    <div class="textbox">
    <input type = "text" name="Username" placeholder="Username"><br/><br/>
    </div>

    <div class="textbox">
    <input type = "password" name="pass" placeholder="Password"><br/><br/>
    </div>

    <div class="textbox">
    <input type = "password" name="repass" placeholder="Repeat Password"><br/><br/>
    </div>

    <div class="log-sign-btn">
        <button type="submit" name="submit">Sign Up</button>
        <a href="./login.php">Already have an Account?</a>
    </div>
</div>
<?php


    if (isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p class='msg2'>Enter all fields.</p>";
    
        }

        elseif($_GET["error"] == "InvalidId"){
            echo "<p class='msg2'>Invalid User Id.</p>";

        }

        elseif($_GET["error"] == "InvalidEmail"){
            echo "<p class='msg2'>Invalid Email.</p>";
        }

        elseif($_GET["error"] == "PasswordsDontMatch"){
            echo "<p class='msg2'>Passwords Don't Match.</p>";
        }

        elseif($_GET["error"] == "PasswordsDontMatch"){
            echo "<p class='msg2'>Passwords Don't Match.</p>";
        }

        elseif($_GET["error"] == "UsernameTaken"){
            echo "<p class='msg2'>The username or email is already taken.</p>";
        }

        elseif($_GET["error"] == "stmtfailed"){
            echo "<p class='msg2'>Something went wrong, try again.</p>";
        }

        elseif($_GET["error"] == "none"){
            echo "<p class='msg2'>You have signed up.</p>";
        }



    }
    ?>
    </form>

</body>

<?php
include './TDFooter.php';

?>
</html>