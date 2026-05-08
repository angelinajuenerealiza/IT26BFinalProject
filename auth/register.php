<?php
include '../config/database.php';

if(isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "staff";

    $sql = "INSERT INTO users(name, email, password, role)
            VALUES('$name', '$email', '$password', '$role')";

    if(mysqli_query($conn, $sql)) {
        echo "Registration Successful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="pas<?php
include '../config/database.php';

if(isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "staff";

    $sql = "INSERT INTO users(name, email, password, role)
            VALUES('$name', '$email', '$password', '$role')";

    if(mysqli_query($conn, $sql)) {
        echo "Registration Successful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>sword" name="password" placeholder="Password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

</body>
</html>