<?php
function emptyInputSignup($id, $pass, $repass){
    $result = true || false;
    if(empty($id) || empty($pass) || empty($repass)){
        $result = true;
    }

    else {
        $result = false;
    }

    return  $result;
}

function InvalidUserId($id){
    $result = true || false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        $result = true;
    }

    else {
        $result = false;
    }

    return  $result;
}


function PwdMatch($pass, $repass) {
    $result = true || false;
    if($pass !== $repass) {
        $result = true;
    }

    else {
        $result = false;
    }

    return  $result;
}

function uidExits($conn, $id) {
 $sql = "SELECT * FROM customers WHERE Username = ?;";
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

function  createuser($conn, $id, $pass) {


    $sql = "INSERT into customers (Username, pass) 
    values (?, ?);";
    

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
     
       header("Location: ./signin.php?error=stmtfailed"); 
       exit();
    }
   
//$hashPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $id, $pass);
    mysqli_stmt_execute($stmt);
   
    mysqli_stmt_close($stmt);
    header("Location: ./signin.php?error=none"); 
    exit();
}

function emptyInputLogin($id, $pass){
    $result = true || false;
    if(empty($id) || empty($pass)){
        $result = true;
    }

    else {
        $result = false;
    }

    return  $result;
}

function loginuser($conn, $id, $pass) {
    $uidExists = uidExits($conn, $id, $id);

    
    if($uidExists === false) {
        header("location: ./login.php?error=wronglogin");
        exit();
    }

    $passHashed = $uidExists["Username"];
    $checkPass = password_verify($pass, $passHashed);

    if($checkPass === false){
       
        header("location: ./login.php?error=wronglogin");
        exit();
    }

    else if($checkPass === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["Username"];
        header("location: ./index.php");
        exit();
    }
}

function loginuser2($conn, $id, $pass) {
    $uidExists = uidExits($conn, $id);


    $query = "SELECT * FROM customers WHERE Username = '$id' AND pass = '$pass';";
    $result=mysqli_query($conn, $query);
    $count= mysqli_num_rows($result);

  
    if($count > 0){
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

function  createMessage($conn, $Fname, $mailFrom, $subject ,$message) {


    $sql = "INSERT into contact (Fullname, email, `subject`, msg) 
    values (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
     
       header("Location: ./index.php?error=stmtfailed"); 
       exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $Fname, $mailFrom, $subject ,$message);
    mysqli_stmt_execute($stmt);
   
    mysqli_stmt_close($stmt);
    header("Location: ./contact.php?error=none"); 
    exit();
}

