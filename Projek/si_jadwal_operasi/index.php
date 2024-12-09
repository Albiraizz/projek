<?php 
    include("config/connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            
            $user = mysqli_fetch_assoc($result);

        
            if ($password == $user['password']) { 
                // Mulai session dan set session untuk pengguna yang login
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];

                
                if ($user['role'] == 'admin') {
                    header("location: dashboard/admin.php");
                    exit();
                } elseif ($user['role'] == 'nurse') {
                    header("location: dashboard/nurse.php");
                    exit();
                } elseif ($user['role'] == 'patient') {
                    header("location: dashboard/patient.php");
                    exit();
                } 
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Username tidak ditemukan!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
