<?php

if (isset($_POST["submit"])) {

    $id =$_POST['id'];
    $pass =$_POST['pass'];
 
    
    require_once './DBHandler.php';
    require_once './Functions.php'; 

   if (emptyInputLogin($id, $pass) !== false){
       header("location: ../HGELogin.php?error=emptyinput");
    exit();
    
 
   }

   loginuser2($connect, $id, $pass);

}
   else
   {
   
    header("location: ../HGEHome.php");
    exit();
   }

