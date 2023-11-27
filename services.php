<?php
include './TDHeader.php';
@include 'config.php';

//send quote request to admin
if(isset($_POST['get_quote'])){

    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $phone = $_POST['phone_no'];
    $address= $_POST['address'];
    $city = $_POST['city_name'];
    $email = $_POST['email'];
    $bookservice = $_POST['service_name'];
 

    if(empty($f_name) || empty($l_name) || empty($phone)
    || empty($address) || empty($city) || empty($email) || empty($bookservice)){
        $msg2[] = 'Please fill out all';
    }
    else{
        $insert ="INSERT INTO quoterequests(fname, lname, phone, address, city, email, service)
         VALUES('$f_name', '$l_name', '$phone', '$address', '$city', '$email', '$bookservice')";
        $send = mysqli_query($conn, $insert);
    
            $msg2[] = 'Quote request sent! ';
    }
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

    <div class="front">
        <img src="./display/fumi.jpg">
        <h3>Our Services</h3>
    </div>

    
    <div class="getquote">

    
        <div class="services-container">
            <div class="service-card2">
             <h4>Janitorial</h4>
           <img src="./display/janitor2.png" alt="">
           <p>
                We will send our personal janitors to clean
                different areas of your building.
                There is no need to purchase any cleanning products
                or cleanning tools, these are all provided for use by the company.
                The number of janitors to be sent will depend on the type of Janitorial 
                service selected. 
           </p><br>
           <p>
                      <h4>Prices</h4>
                      Residential: K850<br>
                      Commercial: K1900
                    </p>
            </div>
            <div class="service-card2">
                 <h4>Fumigation</h4>
                <img src="./display/insect-control.png" alt="">
                     <p>
                        We specialize in pest and insect control, relieving you 
                        of any pesky critters lurking in your premises. No need for you
                        to purchase your own chemicals or equipment, all that is catered 
                        for. The size of the team will depend on the service type chosen.
                    </p><br>

                    <p>
                      <h4>Prices</h4>
                      Residential: K950<br>
                      Commercial: K2300
                    </p>
            </div>
        </div>
        <div class="quote-container">

            <form action="?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <h3>Get a Quote</h3>
                    <input type="text" placeholder="First name*" name="first_name" class="box" required>
                    <input type="text" placeholder="Last name*" name="last_name" class="box" required>
                    <input type="text" placeholder="Phone*" name="phone_no" class="box" required>
                    <input type="text" placeholder="Address*" name="address" class="box" required>
                    <input type="text" placeholder="City*" name="city_name" class="box" required>
                    <input type="text" placeholder="Email*" name="email" class="box" required>
                    
                    <h5>Service to book*</h5>
                    <select name="service_name" class="box">
                    
                        <option value="Fumigation Residential">Fumigation Residential</option>
                        <option value="Fumigation Commercial">Fumigation Commercial</option>
                        <option value="Janitorial Residential">Janitorial Residential</option>
                        <option value="Janitorial Commercial">Janitorial Commercial</option>
                    </select>

                    <input type="submit" class="box" name="get_quote" value="Get Quote">
                

            </form>
        </div>
    </div>
</body>

<?php
include './TDFooter.php';
?>
</html>