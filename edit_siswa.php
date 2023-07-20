<?php
require 'functions.php';

if (isset($_GET['nip'])) {
    $nis = $_GET['nip'];
    $perguruan_tinggi = getPerguruanTinggiByNIP($nip);

    if (!$perguruan_tinggi) {
        header('Location: kelola_siswa.php');
        exit;
    }
} else {
    header('Location: kelola_siswa.php');
    exit;
}

if (isset($_POST['edit_perguruan'])) {
    $nama = $_POST['nama'];
    editPerguruanTinggiByNIP($nip, $nama);
    header('Location: kelola_siswa.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Perguruan Tinggi</title>
</head>
<body>
    <h1>Edit Data perguruan Tinggi</h1>
    <form method="post">
        <label for="nis">Nomer Induk Siswa:</label>
        <input type="text" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" readonly>
        <br>
        <label for="nama">Nama Siswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required>
        <br>
        <input type="submit" name="edit_perguruan" value="Simpan Perubahan">
    </form>
    <br>
    <a href="kelola_siswa.php">Kembali ke Kelola Data Perguruan Tinggi</a>
</body>
</html>
