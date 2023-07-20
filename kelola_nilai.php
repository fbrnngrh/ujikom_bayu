<?php
require 'functions.php';

// Memproses data ketika tombol "Simpan Nilai" ditekan
if (isset($_POST['add_nilai'])) {
    $nip = $_POST['nis'];
    $nilai_angka = $_POST['nilai'];

    $nilai_huruf = getNilaiHuruf($nilai_angka);

    $nilaiAkhirList = getNilaiAkhirFromFile();
    $nilaiAkhirList[] = [
        'nis' => $nis,
        'nilai_angka' => $nilai_angka,
        'nilai_huruf' => $nilai_huruf,
        'tanggal_jam' => date('Y-m-d H:i:s')
    ];

    saveNilaiAkhirToFile($nilaiAkhirList);
}

// Memproses data ketika tombol "Hapus Data Nilai" ditekan
if (isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $nisToDelete = $_GET['nis'];
    hapusNilaiAkhirByNIS($nisToDelete);
}



$nilaiAkhirList = getNilaiAkhirFromFile();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Nilai Akhir</title>
</head>
<body>
    <h1>Kelola Nilai Akreditasi</h1>
    <!-- Tambahkan form untuk menambah data nilai akhir -->
    <h2>Tambah Data Nilai Akreditasi</h2>
    <form method="post">
        <label for="nis">Nomer Induk Perguruan Tinggi</label>
        <input type="text" id="nip" name="nip" required>
        <br>
        <label for="nilai">Nilai Akreditasi:</label>
        <input type="number" id="nilai" name="nilai" required>
        <br>
        <input type="submit" name="add_nilai" value="Simpan Nilai">
    </form>

    <!-- Tampilkan daftar nilai akhir -->
    <h2>Daftar Nilai Akhir</h2>
    <table>
        <tr>
            <th>Nomer Induk Siswa</th>
            <th>Nilai Akhir Angka</th>
            <th>Nilai Akhir Huruf</th>
            <th>Tanggal dan Jam Disimpan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($nilaiAkhirList as $nilaiAkhir): ?>
            <tr>
                <td><?php echo $nilaiAkhir['nis']; ?></td>
                <td><?php echo $nilaiAkhir['nilai_angka']; ?></td>
                <td><?php echo $nilaiAkhir['nilai_huruf']; ?></td>
                <td><?php echo $nilaiAkhir['tanggal_jam']; ?></td>
                <td>
                    <a href="?action=hapus&nis=<?php echo $nilaiAkhir['nis']; ?>">Hapus</a>
                    <a href="edit_nilai.php?nis=<?php echo $nilaiAkhir['nis']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
