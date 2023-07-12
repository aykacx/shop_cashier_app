<?php include_once "db.php";
$sql = $conn->prepare('SELECT * FROM cashier_app_products');
$sql->execute();
$appDb = $sql->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
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

    <div class="container">
        <center>
            <h1>Product list</h1>
        </center>
        <center>
            <table style="background-color: lightgray;">
                <tr>
                    <td>Product number</td>
                    <td>Product name</td>
                    <td>Purchase price</td>
                    <td>Sale price</td>
                    <td>Amount</td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                foreach ($appDb as $row) { ?>
                    <tr>
                        <td>
                            <?= $row->product_number; ?>
                        </td>
                        <td>
                            <?= $row->product_name; ?>
                        </td>
                        <td>
                            <?= $row->purchase_price; ?> $
                        </td>
                        <td>
                            <?= $row->sale_price; ?> $
                        </td>
                        <td>
                            <?= $row->amount; ?>
                        </td>
                        <td><a href="delete_Product.php?id=<?= $row->id; ?>">Delete</a></td>
                        <td><a href="update_Product.php?id=<?= $row->id; ?>">Update</a></td>
                    </tr>
                <?php } ?>
            </table>
        </center>
    </div>
</body>