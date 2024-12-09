<?php 
    include("../../config/connect.php");

    $sql = "SELECT * FROM pengajuan_operasi";

    $result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Operasi</title>
</head>
<body>
    <div class="container">
        <h3>Permintaan Operasi</h3>
        <a href="../../dashboard/admin.php">kembali ke admin</a>
        <table border="1">
        <tr>
            <th>ID Pengajuan</th>
            <th>NO. RM</th>
            <th>Diagnosa</th>
            <th>Dokter</th>
            <th>Action</th>
        </tr>
        <?php foreach ($result as $pengajuan) { ?>
        <tr>
            <td><?= $pengajuan['id_pengajuan'] ?></td>
            <td><?= $pengajuan['no_rm'] ?></td>
            <td><?= $pengajuan['diagnosa'] ?></td>
            <td><?= $pengajuan['nm_dokter'] ?></td>
            <td>
                <a href="acc-schedule.php?id_pengajuan=<?=$pengajuan['id_pengajuan']?>">Terima</a>
                <a href="delete-request.php?id_pengajuan=">Tolak</a>
            </td>
        </tr>
        <?php }?>
    </table>
    </div>
</body>
</html>