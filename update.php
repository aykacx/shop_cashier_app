<?php
include_once 'db.php';
if (isset($_POST['update'])) {
    $pId = $_POST['pId'];
    $pNum = $_POST['pNumber'];
    $pName = $_POST['pName'];
    $pPrice = $_POST['pPrice'];
    $sPrice = $_POST['sPrice'];
    $amount = $_POST['amount'];

    $update = $conn->exec("UPDATE cashier_app_products SET product_number='$pNum', product_name='$pName',purchase_price='$pPrice',sale_price='$sPrice',amount='$amount' WHERE id='$pId' ");

    if ($update) {
        header('location:index.php');
    } else {
        echo 'update failed';
    }

}


?>