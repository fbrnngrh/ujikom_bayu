<?php
require 'functions.php';

$perguruanTinggiCount = count(getPerguruanTinggiFromFile());
$nilaiAkreditasiCount = count(getNilaiAkreditasiFromFile());
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Nilai Akhir Siswa</title>
</head>
<body>
    <h1>Selamat Datang di Aplikasi Manajemen Data Perguruan Tinggi</h1>
    <p>Jumlah Perguruan Tinggi: <?php echo $perguruanTinggiCount ?></p>
    <p>Jumlah Nilai Akreditasi: <?php echo $nilaiAkreditasiCount ?></p>

    <!-- Tambahkan tombol untuk menuju halaman kelola data siswa -->
    <a href="kelola_PerguruanTinggi.php">Kelola Data Perguruan Tinggi</a>
    <br>
    <!-- Tambahkan tombol untuk menuju halaman kelola data nilai akhir -->
    <a href="kelola_NilaiAkreditasi.php">Kelola Nilai Akreditasi</a>
</body>
</html>
