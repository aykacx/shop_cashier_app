<?php include_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light static-top"
        style="height:150px; weight:900px; background-color:lightgray;">
        <div class="container">
            <a style="float:left;" class="navbar-brand" href="index.php">Cahsier App</a>
            <a style="float:right;" class="navbar-brand" href="add_product.php">Add product</a>
            <a style="float:right;" class="navbar-brand" href="sell_product.php">Sell product</a>
            <center>
                <div class="ml-1 mr-5"><img src="img/logo.png" height="150px" width="150px"></div>
            </center>
        </div>
    </nav>
    <center>
        <div class="container">
            <form action="" method="POST">
                Product number: &nbsp; &nbsp; <input name="product_number" type="text" required><br>
                Product name: &nbsp; &nbsp; <input name="product_name" type="text" required><br>
                Purchase price: &nbsp; &nbsp; <input name="purchase_price" type="text" required><br>
                Sale price: &nbsp; &nbsp; <input name="sale_price" type="text" required><br>
                Amount: &nbsp; &nbsp; <input name="amount" type="text" required><br>
                <input type="submit" name="add" value="Add">
            </form>
            <?php

            if (isset($_POST['add'])) {
                $pNumber = $_POST['product_number'];
                $pName = $_POST['product_name'];
                $pPrice = $_POST['purchase_price'];
                $sPrice = $_POST['sale_price'];
                $amount = $_POST['amount'];

                $sql = $conn->prepare('INSERT INTO cashier_app_products SET 
            product_number= :pNum, 
            product_name= :pName,
            purchase_price= :pPrice,
            sale_price= :sPrice,
            amount= :amount ');

                $insertVar = $sql->execute(array("pNum" => $pNumber, "pName" => $pName, "pPrice" => $pPrice, "sPrice" => $sPrice, "amount" => $amount));

                if ($insertVar) {
                    header('location:index.php');
                }

            }
            ?>
        </div>
    </center>
</body>

</html>