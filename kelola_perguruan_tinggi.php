<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data Perguruan Tinggi</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="kelola_perguruan_tinggi.php">Kelola Data Perguruan Tinggi</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Kelola Data Perguruan Tinggi</h1>
            <!-- Tambahkan form untuk menambah data perguruan tinggi -->
            <h2>Tambah Data Perguruan Tinggi</h2>
            <form method="post">
                <label for="nomer_induk">Nomer Induk Perguruan Tinggi:</label>
                <input type="text" id="nomer_induk" name="nomer_induk" required>
                <br>
                <label for="nama">Nama Perguruan Tinggi:</label>
                <input type="text" id="nama" name="nama" required>
                <br>
                <label for="nilai_akreditasi">Nilai Akreditasi:</label>
                <input type="number" id="nilai_akreditasi" name="nilai_akreditasi" required>
                <br>
                <input type="submit" name="add_perguruan_tinggi" value="Tambah Data Perguruan Tinggi">
            </form>

            <?php
            include 'functions.php';

            // Proses tambah data perguruan tinggi
            if (isset($_POST['add_perguruan_tinggi'])) {
                $nomer_induk = $_POST['nomer_induk'];
                $nama = $_POST['nama'];
                $nilai_akreditasi = $_POST['nilai_akreditasi'];
                $result = tambahPerguruanTinggi($nomer_induk, $nama, $nilai_akreditasi);
                if ($result) {
                    echo "<p>Data perguruan tinggi berhasil ditambahkan.</p>";
                } else {
                    echo "<p>Gagal menambahkan data perguruan tinggi.</p>";
                }
            }

            // Proses hapus data perguruan tinggi
            if (isset($_GET['action']) && $_GET['action'] === 'hapus_perguruan_tinggi' && isset($_GET['nomer_induk'])) {
                $nomer_induk = $_GET['nomer_induk'];
                $result = hapusPerguruanTinggi($nomer_induk);
                if ($result) {
                    echo "<p>Data perguruan tinggi berhasil dihapus.</p>";
                } else {
                    echo "<p>Gagal menghapus data perguruan tinggi.</p>";
                }
            }

            // Proses edit data perguruan tinggi
            if (isset($_GET['action']) && $_GET['action'] === 'edit_perguruan_tinggi' && isset($_GET['nomer_induk'])) {
                $nomer_induk = $_GET['nomer_induk'];
                $dataEdit = getPerguruanTinggiByNomerInduk($nomer_induk);

                // Tampilkan form edit data perguruan tinggi
                if ($dataEdit) {
                    echo "<h2>Edit Data Perguruan Tinggi</h2>";
                    echo "<form method=\"post\">";
                    echo "<input type=\"hidden\" name=\"edit_nomer_induk\" value=\"{$dataEdit['nomer_induk']}\">";
                    echo "<label for=\"edit_nama\">Nama Perguruan Tinggi:</label>";
                    echo "<input type=\"text\" id=\"edit_nama\" name=\"edit_nama\" value=\"{$dataEdit['nama']}\" required>";
                    echo "<br>";
                    echo "<label for=\"edit_nilai_akreditasi\">Nilai Akreditasi:</label>";
                    echo "<input type=\"number\" id=\"edit_nilai_akreditasi\" name=\"edit_nilai_akreditasi\" value=\"{$dataEdit['nilai_akreditasi']}\" required>";
                    echo "<br>";
                    echo "<input type=\"submit\" name=\"update_perguruan_tinggi\" value=\"Simpan Perubahan\">";
                    echo "<input type=\"submit\" name=\"cancel_edit_perguruan_tinggi\" value=\"Batal\">";
                    echo "</form>";
                } else {
                    echo "<p>Data perguruan tinggi tidak ditemukan.</p>";
                }
            }

            // Proses update data perguruan tinggi
            if (isset($_POST['update_perguruan_tinggi'])) {
                $nomer_induk = $_POST['edit_nomer_induk'];
                $nama = $_POST['edit_nama'];
                $nilai_akreditasi = $_POST['edit_nilai_akreditasi'];
                $result = updatePerguruanTinggi($nomer_induk, $nama, $nilai_akreditasi);
                if ($result) {
                    echo "<p>Data perguruan tinggi berhasil diperbarui.</p>";
                } else {
                    echo "<p>Gagal memperbarui data perguruan tinggi.</p>";
                }
            }

            // Proses cancel edit data perguruan tinggi
            if (isset($_POST['cancel_edit_perguruan_tinggi'])) {
                $dataEdit = null;
            }

            // Tampilkan daftar perguruan tinggi dalam tabel
            echo "<h2>Daftar Perguruan Tinggi</h2>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nomer Induk Perguruan Tinggi</th>";
            echo "<th>Nama Perguruan Tinggi</th>";
            echo "<th>Nilai Akreditasi</th>";
            echo "<th>Peringkat Akreditasi</th>";
            echo "<th>Tanggal dan Jam Disimpan</th>";
            echo "<th>Aksi</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $dataPerguruanTinggi = getAllPerguruanTinggi();
            foreach ($dataPerguruanTinggi as $perguruanTinggi) {
                echo "<tr>";
                echo "<td>{$perguruanTinggi['nomer_induk']}</td>";
                echo "<td>{$perguruanTinggi['nama']}</td>";
                echo "<td>{$perguruanTinggi['nilai_akreditasi']}</td>";
                echo "<td>{$perguruanTinggi['peringkat_akreditasi']}</td>";
                echo "<td>{$perguruanTinggi['tanggal_jam']}</td>";
                echo "<td>";
                echo "<a href=\"?action=edit_perguruan_tinggi&nomer_induk={$perguruanTinggi['nomer_induk']}\" class=\"edit-btn\"  >Edit</a> | ";
                echo "<a href=\"?action=hapus_perguruan_tinggi&nomer_induk={$perguruanTinggi['nomer_induk']}\" class=\"delete-btn\" class=\"delete-btn\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" >Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Aplikasi Pengelolaan Data Akreditasi Perguruan Tinggi</p>
    </footer>
</body>
</html>
