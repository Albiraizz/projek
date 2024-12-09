<?php
session_start();
include("../../config/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jadwal = mysqli_real_escape_string($conn, $_POST['idjadwal']);
    $id_pengajuan = $_GET['id_pengajuan'];
    $tgl_operasi = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $jam_operasi = mysqli_real_escape_string($conn, $_POST['jam']);
    $id_ruangan = mysqli_real_escape_string($conn, $_POST['ruang']);
    $id_kamar = mysqli_real_escape_string($conn, $_POST['kamar']);

    // Validasi apakah kamar pada jam dan tanggal tertentu sudah dipesan
    $check_query = "SELECT * FROM jadwal_operasi 
                    WHERE id_kamar = '$id_kamar' 
                    AND tanggal_operasi = '$tgl_operasi' 
                    AND jam_operasi = '$jam_operasi'";

    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Kamar sudah dipesan
        $_SESSION['alert'] = 'Kamar sudah dibooking pada waktu tersebut!';
        header("Location: ../../dashboard/admin.php");
        exit();
    }

    // Jika validasi lolos, masukkan data ke tabel jadwal_operasi
    $insert = "INSERT INTO jadwal_operasi (id_jadwal,id_pengajuan, tanggal_operasi, jam_operasi, id_ruangan, id_kamar)
               VALUES (`$id_jadwal`,`$id_pengajuan`, `$tgl_operasi`, `$jam_operasi`, `$id_ruangan`, `$id_kamar`)";

    $res = mysqli_query($conn, $insert);

    if ($res) {
        $_SESSION['alert'] = 'Berhasil menjadwalkan operasi!';
        header("Location: ../../dashboard/admin.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
} else {
    echo "Metode request tidak valid.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima jadwal</title>
</head>
<body>
    <div class="container">
        <h2>Tentukan Jadwal dan Unit</h2>
        <form action="" method="POST">
        <label for="lblnama">Id Mahasiswa</label>
        <input type="text" name="idjadwal" id="idjadwal" size="20" maxlength="20" placeholder="idJadwal">
            <br><br>
        <label for="tanggal">Tanggal jadwal:</label>
            <input type="date" name="tanggal" id=""> <br> <br>
            <label for="ruang">Unit Operasi</label>
            <?php 
                $query = "SELECT * FROM ruangan WHERE status = 'Tersedia'";
                $list_ruangan_tersedia = mysqli_query($conn, $query);
            ?>
                <select name="ruang" id="">
                    <?php foreach ($list_ruangan_tersedia as $ruangan ) { ?>
                <option value="<?= $ruangan['id_ruangan']?>"><?= $ruangan['id_ruangan']?></option>
                <?php }?>
            </select> <br> <br>
            <?php 
                $query = "SELECT * FROM kamar WHERE status = 'Tersedia'";
                $list_kamar_tersedia = mysqli_query($conn, $query);
            ?>
            <label for="kamar">Kamar:</label>
            <select name="kamar" id="">
                <?php foreach ($list_kamar_tersedia as $kamar ) { ?>
                <option value="<?= $kamar['id_kamar']?>">
                    <?= $kamar['id_kamar']?>
                </option>
                <?php }?>
            </select> <br> <br>
            <label for="jam">Jam mulai</label>
            <select name="jam" required>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
            </select> <br> <br>
            <input type="submit" value="Proses">
        </form>
        
    </div>
</body>
</html>