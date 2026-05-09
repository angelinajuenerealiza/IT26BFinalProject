<?php
session_start();
include '../config/database.php';

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

         if(password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            header("Location: ../dashboard/dashboard.php");

        } else {
            echo "Invalid Password";
        }

    } else {
        echo "User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>NBSC BanigHub Login</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
