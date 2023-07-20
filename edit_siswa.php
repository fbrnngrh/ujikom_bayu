<?php
require 'functions.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $siswa = getSiswaByNIS($nis);

    if (!$siswa) {
        header('Location: kelola_siswa.php');
        exit;
    }
} else {
    header('Location: kelola_siswa.php');
    exit;
}

if (isset($_POST['edit_siswa'])) {
    $nama = $_POST['nama'];
    editSiswaByNIS($nis, $nama);
    header('Location: kelola_siswa.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
</head>
<body>
    <h1>Edit Data Siswa</h1>
    <form method="post">
        <label for="nis">Nomer Induk Siswa:</label>
        <input type="text" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" readonly>
        <br>
        <label for="nama">Nama Siswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required>
        <br>
        <input type="submit" name="edit_siswa" value="Simpan Perubahan">
    </form>
    <br>
    <a href="kelola_siswa.php">Kembali ke Kelola Data Siswa</a>
</body>
</html>
