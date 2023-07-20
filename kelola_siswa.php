<?php
require 'functions.php';

// Memproses data ketika tombol "Tambah Data perguruan Tinggi" ditekan
if (isset($_POST['add_perguruan'])) {
    $nip = $_POST['nip'];
    $nama_perguruan = $_POST['nama_perguruan'];

    $perguruanTinggiList = getPerguruanTinggiFromFile();
    $perguruanTinggiList[] = [
        'nip' => $nip,
        'nama_perguruan' => $nama_perguruan,
        'tanggal_jam' => date('Y-m-d H:i:s')
    ];

    savePerguruanTinggiToFile($perguruanTinggiList);
}

// Memproses data ketika tombol "Hapus Data Siswa" ditekan
if (isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $nipToDelete = $_GET['nip'];
    hapusPerguruanTinggiByNIP($nipToDelete);
}


$siswaList = getPerguruanTinggiFromFile();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data Perguruan Tinggi</title>
</head>
<body>
    <h1>Kelola Data Perguruan Tinggi</h1>
    <!-- Tambahkan form untuk menambah data siswa -->
    <h2>Tambah Data Perguruan Tinggi</h2>
    <form method="post">
        <label for="nis">Nomer Induk Perguruan Tinggi:</label>
        <input type="text" id="nip" name="nip" required>
        <br>
        <label for="nama">Nama Perguruan Tinggi:</label>
        <input type="text" id="nama_perguruan" name="nama_perguruan" required>
        <br>
        <input type="submit" name="add_perguruan" value="Tambah Data Perguruan Tinggi">
    </form>

    <!-- Tampilkan daftar siswa -->
    <h2>Daftar Siswa</h2>
    <ul>
        <?php foreach ($siswaList as $siswa): ?>
            <li>
                <?php echo $siswa['nis'] . ' - ' . $siswa['nama']; ?>
                (Tanggal dan Jam Disimpan: <?php echo $siswa['tanggal_jam']; ?>)
                <a href="?action=hapus&nis=<?php echo $siswa['nis']; ?>">Hapus</a>
                <a href="edit_siswa.php?nis=<?php echo $siswa['nis']; ?>">Edit</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
