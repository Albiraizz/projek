<?php 
    include("../../config/connect.php");

    $query = "SELECT * FROM dokter ORDER BY id_dokter ASC";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List dokter</title>
</head>

<body>
    <div class="container">
        <h2>List Dokter</h2>
        <a href="../../dashboard/admin.php">kembali ke admin</a>
        <table border="1">
            <tr>
                <th>No</th>
                <th>ID Dokter</th>
                <th>Nama</th>
                <th>Spesialis</th>
                <th>No.HP</th>
                
            </tr>
            <?php 
                $counter = 1; 
                foreach ($result as $dokter) { 
            ?>
            <tr>
                <td><?= $counter?></td>
                <td><?= $dokter['id_dokter']?></td>
                <td><?= $dokter['nm_dokter']?></td>
                <td><?= $dokter['spesialis']?></td>
                <td><?= $dokter['no_telp']?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</body>

</html>