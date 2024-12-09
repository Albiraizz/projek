<?php
    include("../config/connect.php");
    session_start();
    if (isset($_SESSION['alert'])) {
        echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
        unset($_SESSION['alert']);
    }

    $query = "SELECT * FROM pengajuan_operasi ORDER BY id_pengajuan ASC;";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nurse Dashboard</title>
</head>

<body>
    <h1>Welcome, Perawat</h1>
    <h2>Daftar Operasi</h2>
    <a href="../index.php">logout</a>
    <a href="../pages/nurse/submit-schedule.php" class="btn btn-add">Ajukan jadwal</a> <br><br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Pengajuan</th>
            <th>No. RM</th>
            <th>diagnosa</th>
            <th>Dokter</th>
            <th>status</th>
        </tr>
        <?php foreach ($result as $pengajuan) { ?>
            <tr>
                <td>1</td>
                <td><?= $pengajuan['id_pengajuan']?></td>
                <td><?= $pengajuan['no_rm']?></td>
                <td><?= $pengajuan['diagnosa']?></td>
                <td><?= $pengajuan['nm_dokter']?></td>
                <td><?= $pengajuan['status']?></td>
        </tr>
        <?php }?>
    </table> <br> <br>
</body>

</html>