<?php
include './TDHeader.php';
@include 'config.php';

//add product
if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_FILES['product_img']['name'];
    $product_img_tmp_name = $_FILES['product_img']['tmp_name'];
    $product_img_folder= './Imgs'.$product_img;

    if(empty($product_name) || empty($product_price) || empty($product_img)){
        $msg[] = 'Please fill out all';
    }
    else{
        $insert ="INSERT INTO products(name, price, img) VALUES('$product_name', '$product_price', '$product_img')";
        $upload = mysqli_query($conn, $insert);
        if($upload){
            move_uploaded_file($product_img_tmp_name, $product_img_folder);
            $msg[] = 'new product added!';
        }
        else{
            $msg[] = 'could not add product';
        }
    }
}

//delete product
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin.php');
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


    <div class="adminfront">
       <div class="product-container">

       <form action="?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <h3>Add New Product</h3>
        <input type="text" placeholder="Product name" name="product_name" class="box">
        <input type="number" placeholder="Product price" name="product_price" class="box">
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_img" class="box">
        <input type="submit" class="button" name="add_product" value="Add product">
  
  
       </form>
       </div>

       <?php
       
       $select = mysqli_query($conn, "SELECT * FROM products");
       
       ?>

       <div class="pro-display">

       <table class="pro-display-tbl">
         <thead>
            <tr>
                <th>Product Img</th>
                <th>Product Name</th>
                <th>Product price</th>
                <th colspan="2">Action</th>
            </tr>
         </thead>

         <?php
        
         //view what is in the products page
         while($row = mysqli_fetch_assoc($select)){ ?>

            <tr>
            <td><img src="./Imgs/<?php echo $row['img']; ?>" height="100" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="./admin.php?delete=<?php echo $row['id']; ?>" class="button"> <i class="fas fa-trash"></i>Delete</a>
                </td>
            </tr>
            <?php } ?>
       </table>
       </div>

         
       <?php
       
       $select = mysqli_query($conn, "SELECT * FROM quoterequests");
       
       ?>

       <div class="pro-display">
       <h3>Quote Requests</h3>
       <table class="pro-display-tbl">
         <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Email</th>
                <th>Service</th>
                <th colspan="2">Action</th>
            </tr>
         </thead>

         <?php
        //delete quote requests
        if(isset($_GET['delete2'])){
            $id = $_GET['delete2'];
            mysqli_query($conn, "DELETE FROM quoterequests WHERE id = $id");
            
        }
         //view quote requests sent by customers
         while($row = mysqli_fetch_assoc($select)){ ?>

            <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td>
                    <a href="./admin.php?delete2=<?php echo $row['id']; ?>" class="button"> <i class="fas fa-trash"></i>Delete</a>
                </td>
            </tr>
            <?php } ?>
       </table>
       </div>

    </div>

</body>

<?php
include './TDFooter.php';
?>
</html>