<?php
include '../config/database.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
    "SELECT * FROM transactions WHERE transaction_id='$id'");

$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])) {

    $status = $_POST['status'];

    mysqli_query($conn,
        "UPDATE transactions
         SET status='$status'
         WHERE transaction_id='$id'");

    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaction</title>
</head>
<body>

<h2>Edit Transaction</h2>

<form method="POST">

    <label>Status</label><br>

    <select name="status">
        <option value="Borrowed">Borrowed</option>
        <option value="Returned">Returned</option>
    </select>

    <br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
