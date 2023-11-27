<?php
include './TDHeader.php';
@include './config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tidy Mulo's Official</title>
    
</head>

<body>
<form method="POST">
    

<div class="pay-for">
<h2>Confirm Payment</h2>
    <div class="row1">
        <div class="Owner">
            <h3>Owner</h3>
            <div  class="input-field">
            <input type="text" required>
            </div>
        </div>

        <div class="cvv">
            <h3>CVV</h3>
            <div  class="input-field">
            <input type="text" required>
            </div>
        </div>
    </div>

    <div class="row2">
        <div class="cardNo">
            <h3>Card Number</h3>
            <div  class="input-field">
            <input type="text" name="cardno" required>
            </div>
        </div>
    </div>

    <div class="row3">
 
    <div class="selection">
        <div class="date">
            <select name="months" id="months">
                <option value="jan">Jan</option>
                <option value="feb">Feb</option>
                <option value="mar">Mar</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="jun">Jun</option>
                <option value="jul">Jul</option>
                <option value="aug">Aug</option>
                <option value="sep">Sept</option>
                <option value="oct">Oct</option>
                <option value="nov">Nov</option>
                <option value="dec">Dec</option>
            </select>
            <select name="years" id="years">
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
            </select>

        </div>

        <div class="pay-cards">
            <img src="./display/visa.png" alt="">
            <img src="./display/paypal.png" alt="">
        </div>
    </div>
    </div>
    <div class="Checkout">
    <button type="submit">Confirm</button>
    </div>
</div>
</form>
</body>

<?php
include './TDFooter.php';
?>
</html>