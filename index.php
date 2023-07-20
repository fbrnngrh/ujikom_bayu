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
    <h1>Selamat Datang di Aplikasi Manajemen Nilai Akhir Siswa</h1>
    <p>Jumlah Perguruan Tinggi: <?php echo $perguruanTinggiCount ?></p>
    <p>Jumlah Nilai Akreditasi: <?php echo $nilaiAkreditasiCount ?></p>

    <!-- Tambahkan tombol untuk menuju halaman kelola data siswa -->
    <a href="kelola_siswa.php">Kelola Data Siswa</a>
    <br>
    <!-- Tambahkan tombol untuk menuju halaman kelola data nilai akhir -->
    <a href="kelola_nilai.php">Kelola Nilai Akhir</a>
</body>
</html>
