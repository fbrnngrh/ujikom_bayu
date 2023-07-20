<!DOCTYPE html>
<html>
<head>
    <title>Beranda</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <h1>Selamat datang di Aplikasi Pengelolaan Data Akreditasi Perguruan Tinggi</h1>

            <?php
            include 'functions.php';

            // Mendapatkan data statistik untuk chart
            $dataPerguruanTinggi = getAllPerguruanTinggi();
            $labels = array();
            $nilaiAkreditasi = array();
            $peringkatAkreditasiA = 0;
            $peringkatAkreditasiB = 0;
            $peringkatAkreditasiC = 0;
            $peringkatTidakAkreditasi = 0;

            foreach ($dataPerguruanTinggi as $perguruanTinggi) {
                $labels[] = $perguruanTinggi['nama'];
                $nilaiAkreditasi[] = $perguruanTinggi['nilai_akreditasi'];

                $peringkat_akreditasi = $perguruanTinggi['peringkat_akreditasi'];
                switch ($peringkat_akreditasi) {
                    case 'A':
                        $peringkatAkreditasiA++;
                        break;
                    case 'B':
                        $peringkatAkreditasiB++;
                        break;
                    case 'C':
                        $peringkatAkreditasiC++;
                        break;
                    default:
                        $peringkatTidakAkreditasi++;
                        break;
                }
            }
            ?>

            <!-- Tampilkan chart dengan data statistik -->
            <h2>Statistik Perguruan Tinggi berdasarkan Nilai Akreditasi</h2>
            <canvas id="chartPerguruanTinggi" width="800" height="400"></canvas>

            <script>
                var ctx = document.getElementById('chartPerguruanTinggi').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            label: 'Nilai Akreditasi',
                            data: <?php echo json_encode($nilaiAkreditasi); ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
            <!-- Tampilkan form pencarian -->
            <h2>Pencarian Perguruan Tinggi</h2>
            <form method="GET">
                <label for="search">Cari Perguruan Tinggi:</label>
                <input type="text" id="search" name="search" placeholder="Masukkan Nama Perguruan Tinggi">
                <input type="submit" value="Cari">
            </form>

            <!-- Tampilkan hasil pencarian -->
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $dataPerguruanTinggi = cariPerguruanTinggi($search);

                if (empty($dataPerguruanTinggi)) {
                    echo "<p>Tidak ditemukan hasil untuk kata kunci pencarian '$search'.</p>";
                } else {
                    echo "<h2>Hasil Pencarian</h2>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Nomer Induk Perguruan Tinggi</th>";
                    echo "<th>Nama Perguruan Tinggi</th>";
                    echo "<th>Nilai Akreditasi</th>";
                    echo "<th>Peringkat Akreditasi</th>";
                    echo "<th>Tanggal dan Jam Disimpan</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($dataPerguruanTinggi as $perguruanTinggi) {
                        echo "<tr>";
                        echo "<td>{$perguruanTinggi['nomer_induk']}</td>";
                        echo "<td>{$perguruanTinggi['nama']}</td>";
                        echo "<td>{$perguruanTinggi['nilai_akreditasi']}</td>";
                        echo "<td>{$perguruanTinggi['peringkat_akreditasi']}</td>";
                        echo "<td>{$perguruanTinggi['tanggal_jam']}</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            }
            ?>

            <!-- Tampilkan data statistik peringkat akreditasi -->
            <h2>Statistik Perguruan Tinggi berdasarkan Peringkat Akreditasi</h2>
            <table>
                <tr>
                    <th>Peringkat Akreditasi</th>
                    <th>Jumlah Perguruan Tinggi</th>
                </tr>
                <tr>
                    <td>A</td>
                    <td><?php echo $peringkatAkreditasiA; ?></td>
                </tr>
                <tr>
                    <td>B</td>
                    <td><?php echo $peringkatAkreditasiB; ?></td>
                </tr>
                <tr>
                    <td>C</td>
                    <td><?php echo $peringkatAkreditasiC; ?></td>
                </tr>
                <tr>
                    <td>Tidak Terakreditasi</td>
                    <td><?php echo $peringkatTidakAkreditasi; ?></td>
                </tr>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Aplikasi Pengelolaan Data Akreditasi Perguruan Tinggi</p>
    </footer>
</body>
</html>
