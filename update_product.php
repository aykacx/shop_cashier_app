<?php
include_once 'db.php';
$pId = $_GET['id'];
$sql = $conn->prepare('SELECT * FROM cashier_app_products WHERE id= :product_id');
$sql->execute(['product_id' => $pId]);
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <nav style="height:150px; background-color:lightgray;">
        <div class="container">
            <a style="float:left;" href="index.php">Cahsier App</a>
            <a style="float:right;" href="add_product.php">Add product</a>
            <a style="float:right;" href="sell_product.php">Sell product</a>
            <center>
                <div><img src="img/logo.png" height="150px" width="150px"></div>
            </center>
        </div>
    </nav>
    <center>
        <h3>Update product</h3><br>
        <form action="update.php" method="POST">
            Product ID: <input type="number" name="pId" value="<?php echo $pId; ?>" readonly><br>
            Product Number: <input type="number" name="pNumber" value="<?php echo $fetch['product_number']; ?>"><br>
            Product Name: <input type="text" name="pName" value="<?php echo $fetch['product_name']; ?>"><br>
            Purchase Price: <input type="number" name="pPrice" value="<?php echo $fetch['purchase_price']; ?>"><br>
            Sale Price: <input type="number" name="sPrice" value="<?php echo $fetch['sale_price']; ?>"><br>
            Amount: <input type="number" name="amount" value="<?php echo $fetch['amount']; ?>">
            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>

</html>