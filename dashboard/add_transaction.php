<?php
include '../config/database.php';
include '../auth/session.php';

if(isset($_POST['save'])) {

    $borrower_id = $_POST['borrower_id'];
    $user_id = $_SESSION['user_id'];
    $date_borrowed = $_POST['date_borrowed'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO transactions
            (borrower_id, user_id, date_borrowed, due_date, status)
            VALUES
            ('$borrower_id', '$user_id', '$date_borrowed', '$due_date', '$status')";

    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction</title>
</head>
<body>

<h2>Add Transaction</h2>

<form method="POST">

    <label>Borrower ID</label><br>
    <input type="number" name="borrower_id" required><br><br>

    <label>Date Borrowed</label><br>
    <input type="date" name="date_borrowed" required><br><br>

    <label>Due Date</label><br>
    <input type="date" name="due_date" required><br><br>

       <label>Due Date</label><br>
    <input type="date" name="due_date" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Borrowed">Borrowed</option>
        <option value="Returned">Returned</option>
    </select>

    <br><br>

    <button type="submit" name="save">Save</button>
</form>

</body>
</html>