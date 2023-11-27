<?php

if (isset($_POST["submit"])) {

    $id =$_POST['Username'];
    $pass =$_POST['pass'];
    $repass =$_POST['repass'];
    
    require_once './config.php';
    require_once './Includes/Functions.php';


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

    
    if (uidExits($connect, $id) !== false){
        header("Location: ../signin.php?error=UsernameTaken"); 
       exit();
    }

    createuser($connect, $id, $pass);



}

else {
    header("Location: ../HGEHome.php?error=none"); 
    exit();
}




