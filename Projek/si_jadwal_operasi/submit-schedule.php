<?php 
    session_start();
    include("../../config/connect.php");

    if($_SERVER['REQUEST_METHOD' ] == 'POST') {
        $no_rm = $_POST["no_rm"];
        $diagnosa = $_POST["diagnosa"];
        $nama_dokter = $_POST["nm_dokter"];

        $sql = "INSERT INTO pengajuan_operasi(no_rm, diagnosa, nm_dokter) VALUES ('$no_rm', '$diagnosa', '$nama_dokter');";
        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn) > 0) {
            $_SESSION['alert'] = 'Berhasil mengajukan';
            header("Location: ../../dashboard/nurse.php");
            exit();
        } else {
            echo "gagal";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan jadwal - Nurse</title>
</head>

<body>
    <div class="container">
        <h2>Ajukan Jadwal Operasi</h2>
        <p>Admin akan mengatur jadwal</p>
        <form action="" method="POST">
            <input type="text" name="no_rm" id="" placeholder="No. RM" required> <br> <br>
            <input type="text" name="diagnosa" id="" placeholder="Diagnosa" required> <br> <br>
            <?php 
                $query = "SELECT * FROM dokter ORDER BY id_dokter ASC;";
                $result = mysqli_query($conn, $query);
            ?>
            <label for="nm_dokter">Pilih Dokter: </label>
            <select name="nm_dokter" id="nm_dokter">
                <?php foreach ($result as $dokter) { ?>
                    <option value="<?=$dokter['nm_dokter']?>"><?=$dokter['nm_dokter']?></option>
                <?php } ?>
                </select>
            <br> <br>
            <input type="submit" value="Kirim data ke admin">
        </form>
    </div>
</body>

</html>