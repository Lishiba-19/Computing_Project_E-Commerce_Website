<?php
include './TDHeader.php';
@include './config.php';

//update quantity of product
if(isset($_POST['update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value'
    WHERE id = '$update_id'");
    if($update_quantity_query){
        header('location: cart.php');
    }
}

//remove item from cart
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id= '$remove_id'");
    header('location: cart.php');
}

//remove all items from cart
if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location: cart.php');
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
      
    </div>

    <section class="shopping-cart">

    <h1>shopping cart</h1>
    <table>
        <thead>
            <th>Image</th>
            <th>name</th>
            <th>price</th>
            <th>quantity</th>
            <th>total price</th>
            <th>action</th>

            <tbody>

            <?php
            
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){

            ?>

            <tr>
                <td><img src="./Imgs/<?php echo $fetch_cart['img']; ?>" alt=""></td>
                <td><?php echo $fetch_cart['name']; ?></td>
                <td>K<?php echo $sub_total = number_format($fetch_cart['price']); ?></td>
                <td>
                    <form action="" method="POST">
                    
                    <input type="hidden" name="update_quantity_id" min="1" value="<?php echo $fetch_cart['id']; ?>">
                  
                    <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" value="update" name="update_btn">
                    </form>
                </td>
                <td>K<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="
                return confirm('remove from cart?')" class="button"> <i class="fas fa-trash"></i>remove</a></td>
            </tr>
            <?php
            $grand_total += $sub_total;
                };
            };
        
            ?>
            <tr class="table-bottom">
                <td><a href="products.php" class="button" 
                >Continue shopping</a></td>
                <td colspan="3">Grand total</td>
                <td>K<?php echo $grand_total; ?></td>
                <td><a href="cart.php?delete_all" 
                onclick="return confirm('Are you sure you want to delete all items from cart?');" class="button"> <i class="fas fa-trash"></i>Delete all</a></td>
            </tr>

            </tbody>

        </thead>
    </table>
       
    <div class="checkout-btn">
        <a href="./checkout.php"  onclick="
                return confirm('Proceed to checkout?')" class="button <?= ($grand_total > 1)?'':'disabled'; ?>">checkout</a>
    </div>

    </section>

</body>

<?php
include './TDFooter.php';
?>
</html>