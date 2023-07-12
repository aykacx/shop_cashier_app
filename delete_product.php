<?php
include_once 'db.php';

if (isset($_GET['id'])) {
    $pId = $_GET['id'];
    $sql = $conn->prepare("DELETE FROM cashier_app_products WHERE id='$pId'");
    $delExec = $sql->execute();

    if ($delExec) {
        header('location:index.php');
    }
    else {
        echo 'Delete failed';
    }
}
?>