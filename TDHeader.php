<?php
session_start();
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tidy Mulo's Official</title>
    <link href="./TDStyle.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
</head>

<header class="Header">

<div class="flex">
<div class="Logo">
    <h1>Tidy Mulo's CC</h1>
</div>

<input type="checkbox" id="menu-bar">
<label for="menu-bar"><i class="fas fa-bars"></i></label>

<div class="Links">
    <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./services.php">Our Services</a></li>
        <li><a href="./products.php">Products</a></li>
        <li><a href="./about.php">About Us</a></li>

        <?php
           if (isset($_SESSION["useruid"])){
            echo "<li><a href='./contact.php'> Contact</a></li>";
            echo "<li><a href='./Includes/LogOutMagic.php'> Logout</a></li>";
  
        } 

        elseif(isset($_SESSION["Admin"])){
            
            echo "<li><a href='./contact.php'> Contact</a></li>";
            echo "<li><a href='./admin.php'><i class='fas fa-user'></i></a></li>";
            echo "<li><a href='./Includes/LogOutMagic.php' onclick='
            return confirm('Are you sure you want to logout?')'> Logout</a></li>";
  
        } 
        else {

           echo "<li><a href='./signin.php'> Sign-up</a></li>";
           echo "<li><a href='./login.php'> Log-in</a></li>";
        }
        ?>

  
    </ul>

     
    <div class="LinksB">
      
    </div>
</div>
<?php
         $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
         $row_count = mysqli_num_rows($select_rows);
        ?>
        <a href="./cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo $row_count; ?></a></span>
      
</div>
</header>
<body>

<div class="cookie-container">
     <p>We use cookies in this website to offer you the best experience
        on the site and show you relevant ads. To learn more, read our 
        <a href="#">privacy policy</a>.<br>
        <button class="cookie-btn">Okay</button>
     </p>
 </div>

 <script type="text/javascript">

const cookieContainer = document.querySelector(".cookie-container");
const cookieBtn = document.querySelector(".cookie-btn");

cookieBtn.addEventListener('click', () =>{
    cookieContainer.classList.remove('active');
    localStorage.setItem("cookiesDisplayed", true);
});


setTimeout(() => {
    if(!localStorage.getItem("cookiesDisplayed"))
    cookieContainer.classList.add('active');
}, 2000);


</script>
</body>
</html>