<?php include_once "db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Product</title>
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
        <div>
            <form method="POST">
                <select name="product_number">
                    <?php
                    $sql = $conn->query("SELECT * FROM cashier_app_products", PDO::FETCH_ASSOC);
                    if ($sql->rowCount()) {
                        foreach ($sql as $row) {
                            print("<option value='" . $row['product_number'] . "'>" . $row['product_name'] . "</option>");
                        }
                    }
                    ?>
                    Piece:&nbsp; <input type="number" name="piece" required>
                    <input type="submit" name="sell" value="Sell">
                </select>
            </form>
            <?php
            if (isset($_POST['sell'])) {
                $pNum = $_POST['product_number'];
                $piece = $_POST['piece'];
                $sql2 = $conn->query("SELECT purchase_price, sale_price,amount FROM cashier_app_products WHERE product_number = $pNum")->fetch(PDO::FETCH_ASSOC);
                if ($sql2) {
                    $pPrice = $sql2['purchase_price'];
                    $sPrice = $sql2['sale_price'];
                    $amount = $sql2['amount'];

                    $remain = $amount - $piece;
                    if ($remain == -1) {
                        echo 'insufficient stock. need to update stock';
                    } else {
                        $profit = ($sPrice - $pPrice) * $piece;

                        $sqlInsertSale = $conn->prepare('INSERT INTO cashier_app_sales (product_number, piece, earnings) VALUES (?,?,?)');

                        $executeSale = $sqlInsertSale->execute([$pNum, $piece, $profit]);

                        if ($executeSale) {
                            $lastId = $conn->lastInsertId();
                            print("Sales transaction successful");
                        }

                        $updateProductAmount = $conn->prepare('UPDATE cashier_app_products SET amount=:newAmount WHERE product_number = :pNum');

                        $executeUpdate = $updateProductAmount->execute(array('newAmount' => $remain, 'pNum' => $pNum));
                    }
                }
            }
            ?>
        </div>
    </center>
    <center>
        <div>
            <table style="width:350px; background-color:lightgray; text-align:center;">
                <tr>
                    <td>Product Number</td>
                    <td>Piece</td>
                    <td>Profit</td>
                </tr>
                <?php
                $totalProfit = 0;
                $sqlSales = $conn->query('SELECT * FROM cashier_app_sales', PDO::FETCH_ASSOC);
                if ($sqlSales) {
                    foreach ($sqlSales as $row) {
                        print '<tr><td>' . $row['product_number'] . '</td><td>' . $row['piece'] . '</td><td>' . $row['earnings'] . '$' . '</tr></td>';
                        $totalProfit += $row['earnings'];
                    }
                }
                ?>
            </table>
            <table style="margin-top:10px; background-color: lightblue;">
                <tr>
                    <td>Total Profit: </td>
                    <td>
                        <?php print $totalProfit . '$'; ?>
                    </td>
                </tr>
            </table>
            <form method="POST">
                <input type="submit" name="delete" value="Delete all sale data">
            </form>
            <?php
            if (isset($_POST['delete'])) {
                $sqlDelete = $conn->exec('DELETE FROM cashier_app_sales');
                echo 'All sale data was deleted';
                header('location:sell_product.php');
            }
            ?>
        </div>
    </center>
</body>

</html>