<?php
include './TDHeader.php';
@include 'config.php';

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_POST['product_img'];
    $product_qnty =  1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if(mysqli_num_rows($select_cart) > 0){
        $msg[] = 'Product already added to cart';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, img, quantity)
        VALUES ('$product_name', '$product_price', '$product_img', '$product_qnty')");
        $msg[] = 'Product added to cart succesfully!';
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

<?php
if(isset($msg)){
    foreach($msg as $msg){
        echo'<span class="msg">'.$msg.'</span>';
    }
}

?>
    <div class="offers">
        <section class="each-offer">
            <h1>Here's our latest</h1>

            <div class="box-container">
                <?php

                    $select_products = mysqli_query($conn, "SELECT * FROM `products`");

                    if(mysqli_num_rows($select_products) > 0){
                        while($fetch_products = mysqli_fetch_assoc($select_products)){
                    
                ?>

                <form action="" method="POST">
                    <div class="offer-box">
                        <img src="./Imgs/<?php echo $fetch_products['img']; ?>" alt="">
                        <h3><?php echo $fetch_products['name']; ?></h3>
                        <div class="price">K<?php echo $fetch_products['price']; ?></div>

                        <input type="hidden" value="<?php echo $fetch_products['name']; ?>" name="product_name">
                        <input type="hidden" value="<?php echo $fetch_products['price']; ?>" name="product_price">
                        <input type="hidden" value="<?php echo $fetch_products['img']; ?>" name="product_img">

                        <input type="submit" class="button" value="add to cart" name="add_to_cart">
                    </div>
                </form>

                <?php
                    };
                };
                ?>
            </div>
        </section>
    </div>

</body>

<?php
include './TDFooter.php';
?>
</html>