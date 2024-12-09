<?php
    include("../config/connect.php");
    session_start();
    if (isset($_SESSION['alert'])) {
        echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
        unset($_SESSION['alert']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard-Admin</title>
</head>

<body>
    <h1>Welcome, Admin</h1>
    <ul>
        <li><a href="../pages/admin/request-schedule.php">Request Schedules</a></li>
        <li><a href="../pages/admin/doctor-list.php">List Doctor</a></li>
        <li><a href="../pages/admin/operation-list.php">List Operation</a></li>
        <li><a href="../pages/admin/room-list.php">List Room</a></li>
    </ul>
    <a href="../index.php">logout</a>
</body>

</html>