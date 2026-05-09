<?php
include '../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM transactions
     WHERE transaction_id='$id'");

header("Location: dashboard.php");
?>