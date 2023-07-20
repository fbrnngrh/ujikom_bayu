<?php
require 'functions.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $nilaiAkhir = getNilaiAkhirByNIS($nis);

    if (!$nilaiAkhir) {
        header('Location: kelola_nilai.php');
        exit;
    }
} else {
    header('Location: kelola_nilai.php');
    exit;
}

if (isset($_POST['edit_nilai'])) {
    $nilai_angka = $_POST['nilai'];
    editNilaiAkhirByNIS($nis, $nilai_angka);
    header('Location: kelola_nilai.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Nilai Akhir</title>
</head>
<body>
    <h1>Edit Data Nilai Akhir</h1>
    <form method="post">
        <label for="nis">Nomer Induk Siswa:</label>
        <input type="text" id="nis" name="nis" value="<?php echo $nilaiAkhir['nis']; ?>" readonly>
        <br>
        <label for="nilai">Nilai Akhir Angka:</label>
        <input type="number" id="nilai" name="nilai" value="<?php echo $nilaiAkhir['nilai_angka']; ?>" required>
        <br>
        <input type="submit" name="edit_nilai" value="Simpan Perubahan">
    </form>
    <br>
    <a href="kelola_nilai.php">Kembali ke Kelola Nilai Akhir</a>
</body>
</html>
