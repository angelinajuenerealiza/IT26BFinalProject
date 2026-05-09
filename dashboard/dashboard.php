<?php
include '../auth/session.php';
include '../config/database.php';

// INNER JOIN QUERY
$sql = "SELECT
            t.transaction_id,
            b.full_name,
            u.name AS staff,
            t.date_borrowed,
            t.due_date,
            t.status
        FROM transactions t
        INNER JOIN borrowers b
            ON t.borrower_id = b.borrower_id
        INNER JOIN users u
            ON t.user_id = u.user_id";

$result = mysqli_query($conn, $sql);

// CHART QUERY
$chartQuery = "SELECT status, COUNT(*) AS total
               FROM transactions
               GROUP BY status";

$chartResult = mysqli_query($conn, $chartQuery);

$status = [];
$total = [];

while($row = mysqli_fetch_assoc($chartResult)) {
    $status[] = $row['status'];
    $total[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 10px;

         }

        th {
            background: #ddd;
        }
    </style>
</head>
<body>

<h1>NBSC BanigHub Dashboard</h1>

<p>Welcome, <?php echo $_SESSION['name']; ?></p>

<a href="../auth/logout.php">Logout</a>
<br><br>

<a href="add_transaction.php">Add Transaction</a>

<h2>Borrowing Records</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Borrower</th>
        <th>Staff</th>
        <th>Date Borrowed</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

    <tr>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['full_name']; ?></td>
        <td><?php echo $row['staff']; ?></td>
        <td><?php echo $row['date_borrowed']; ?></td>
        <td><?php echo $row['due_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <a href="edit_transaction.php?id=<?php echo $row['transaction_id']; ?>">Edit</a>
            |
            <a href="delete_transaction.php?id=<?php echo $row['transaction_id']; ?>"
               onclick="return confirm('Delete this record?')">
               Delete
            </a>
        </td>
    </tr>

    <?php } ?>
</table>

<h2>Transaction Statistics</h2>

<canvas id="myChart"></canvas>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($status); ?>,
        datasets: [{
            label: 'Transactions',
            data: <?php echo json_encode($total); ?>,
            borderWidth: 1
        }]
    }
});

</script>

</body>
</html>