<?php

// Fungsi untuk membaca data dari file
function readDataFromFile($filename) {
    $data = array();
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data[] = json_decode($line, true);
            }
            fclose($file);
        }
    }
    return $data;
}


// Fungsi untuk menulis data ke file
function writeDataToFile($filename, $data) {
    $file = fopen($filename, 'w');
    if ($file) {
        foreach ($data as $item) {
            fwrite($file, json_encode($item) . "\n");
        }
        fclose($file);
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mendapatkan peringkat akreditasi berdasarkan nilai akreditasi
function getPeringkatAkreditasi($nilai_akreditasi) {
    if ($nilai_akreditasi >= 361 && $nilai_akreditasi <= 400) {
        return 'A';
    } elseif ($nilai_akreditasi >= 301 && $nilai_akreditasi <= 360) {
        return 'B';
    } elseif ($nilai_akreditasi >= 200 && $nilai_akreditasi <= 300) {
        return 'C';
    } else {
        return 'Tidak terakreditasi';
    }
}

// Fungsi untuk mendapatkan data perguruan tinggi berdasarkan nomer induk
function getPerguruanTinggiByNomerInduk($nomer_induk) {
    $data = readDataFromFile('perguruan_tinggi.txt');
    foreach ($data as $item) {
        if ($item['nomer_induk'] === $nomer_induk) {
            return $item;
        }
    }
    return null;
}

// Fungsi untuk mendapatkan data nilai akreditasi berdasarkan nomer induk
function getNilaiAkreditasiByNomerInduk($nomer_induk) {
    $data = readDataFromFile('nilai_akreditasi.txt');
    foreach ($data as $item) {
        if ($item['nomer_induk'] === $nomer_induk) {
            return $item;
        }
    }
    return null;
}

// Fungsi untuk mendapatkan semua data perguruan tinggi
function getAllPerguruanTinggi() {
    // tampilkan data perguruan tinggi dalam urutan descending berdasarkan nilai akreditasi
    $data = readDataFromFile('perguruan_tinggi.txt');
    usort($data, function ($item1, $item2) {
        return $item2['nilai_akreditasi'] <=> $item1['nilai_akreditasi'];
    });

    return $data;
}


// Fungsi untuk menambah data perguruan tinggi
function tambahPerguruanTinggi($nomer_induk, $nama, $nilai_akreditasi) {
    $data = getAllPerguruanTinggi();
    $peringkat_akreditasi = getPeringkatAkreditasi($nilai_akreditasi);
    $tanggal_jam = date('Y-m-d H:i:s');
    $data[] = array(
        'nomer_induk' => $nomer_induk,
        'nama' => $nama,
        'nilai_akreditasi' => $nilai_akreditasi,
        'peringkat_akreditasi' => $peringkat_akreditasi,
        'tanggal_jam' => $tanggal_jam
    );
    return writeDataToFile('perguruan_tinggi.txt', $data);
}

// Fungsi untuk mencari data perguruan tinggi berdasarkan nama
function searchPerguruanTinggi($keyword)
{
    $data = readDataFromFile('data_perguruan_tinggi.txt');
    $result = array();

    foreach ($data as $perguruanTinggi) {
        if (stripos($perguruanTinggi['nama'], $keyword) !== false) {
            $result[] = $perguruanTinggi;
        }
    }

    return $result;
}


// Fungsi untuk menghapus data perguruan tinggi berdasarkan nomor induk
function hapusPerguruanTinggi($nomer_induk) {
    $data = getAllPerguruanTinggi();
    $filteredData = array_filter($data, function ($item) use ($nomer_induk) {
        return $item['nomer_induk'] !== $nomer_induk;
    });
    return writeDataToFile('perguruan_tinggi.txt', $filteredData);
}

// Fungsi untuk menghapus data nilai akreditasi berdasarkan nomor induk


// Fungsi untuk memperbarui data perguruan tinggi berdasarkan nomor induk
function updatePerguruanTinggi($nomer_induk, $nama, $nilai_akreditasi) {
    $data = getAllPerguruanTinggi();
    $updatedData = array_map(function ($item) use ($nomer_induk, $nama, $nilai_akreditasi) {
        if ($item['nomer_induk'] === $nomer_induk) {
            $item['nama'] = $nama;
            $item['nilai_akreditasi'] = $nilai_akreditasi;
            $item['peringkat_akreditasi'] = getPeringkatAkreditasi($nilai_akreditasi);
            $item['tanggal_jam'] = date('Y-m-d H:i:s');
        }
        return $item;
    }, $data);
    return writeDataToFile('perguruan_tinggi.txt', $updatedData);
}

// Fungsi untuk memperbarui data nilai akreditasi berdasarkan nomor induk


?>
