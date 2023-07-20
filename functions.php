<?php

// Fungsi untuk menghitung nilai huruf berdasarkan nilai angka
function getNilaiHuruf($nilai_angka)
{
    if ($nilai_angka >= 361 && $nilai_angka <= 400) {
        return 'A';
    } elseif ($nilai_angka >= 301 && $nilai_angka < 360) {
        return 'B';
    } elseif ($nilai_angka >= 200 && $nilai_angka < 300) {
        return 'C';
    }  else {
        return 'Tidak Terakreditasi';
    }
}

// Fungsi untuk menyimpan data Perguruan Tinggi ke dalam file txt dalam bentuk array
function savePerguruanTinggiToFile($perguruanTinggiList)
{
    $fileContent = serialize($perguruanTinggiList);
    file_put_contents('perguruan_tinggi.txt', $fileContent);
}

// Fungsi untuk menyimpan data nilai akreditasi ke dalam file txt dalam bentuk array
function saveNilaiAkreditasiToFile($nilaiAkreditasiList)
{
    $fileContent = serialize($nilaiAkreditasiList);
    file_put_contents('nilai_akreditasi.txt', $fileContent);
}

// Fungsi untuk membaca data perguruan tinggi dari file txt dan mengembalikan dalam bentuk array
function getPerguruanTinggiFromFile()
{
    $fileContent = file_get_contents('perguruan_tinggi.txt');
    $perguruanTinggiList = unserialize($fileContent);
    if (!is_array($perguruanTinggiList)) {
        $perguruanTinggiList = []; // Jika data kosong atau file tidak ada, inisialisasi dengan array kosong
    }
    return $perguruanTinggiList;
}

// Fungsi untuk membaca data nilai akreditasi dari file txt dan mengembalikan dalam bentuk array
function getNilaiAkreditasiFromFile()
{
    $fileContent = file_get_contents('nilai_akreditasi.txt');
    $nilaiAkreditasiList = unserialize($fileContent);
    if (!is_array($nilaiAkreditasiList)) {
        $nilaiAkreditasiList = []; // Jika data kosong atau file tidak ada, inisialisasi dengan array kosong
    }
    return $nilaiAkreditasiList;
}

// Fungsi untuk menghapus data perguruan tinggi berdasarkan NIP dari file txt
function hapusPerguruanTinggiByNIP($nip)
{
    $perguruanTinggiList = getPerguruanTinggiFromFile();
    foreach ($perguruanTinggiList as $key => $perguruanTinggi) {
        if ($perguruanTinggi['nip'] === $nip) {
            unset($perguruanTinggiList[$key]);
            break;
        }
    }
    savePerguruanTinggiToFile($perguruanTinggiList);
}

// Fungsi untuk menghapus data nilai akreditasi berdasarkan NIP dari file txt
function hapusNilaiAkreditasiByNIP($nip)
{
    $nilaiAkreditasiList = getNilaiAkreditasiFromFile();
    foreach ($nilaiAkreditasiList as $key => $nilaiAkreditasi) {
        if ($nilaiAkreditasi['nip'] === $nip) {
            unset($nilaiAkreditasiList[$key]);
            break;
        }
    }
    saveNilaiAkreditasiToFile($nilaiAkreditasiList);
}

// Fungsi untuk mendapatkan data perguruan Tinggi berdasarkan NIP dari file txt
function getPerguruanTinggiByNIP($nip)
{
    $perguruanTinggiList = getPerguruanTinggiFromFile();
    foreach ($perguruanTinggiList as $perguruanTinggi) {
        if ($perguruanTinggi['nip'] === $nip) {
            return $perguruanTinggi;
        }
    }
    return null;
}

// Fungsi untuk mendapatkan data nilai akreditasi berdasarkan NIP dari file txt
function getNilaiAkreditasiByNIP($nip)
{
    $nilaiAkreditasiList = getNilaiAkreditasiFromFile();
    foreach ($nilaiAkreditasiList as $nilaiAkreditasi) {
        if ($nilaiAkreditasi['nip'] === $nip) {
            return $nilaiAkreditasi;
        }
    }
    return null;
}

// Fungsi untuk mengubah data perguruan tinggi berdasarkan NIP di dalam file txt
function editPerguruanTinggiByNIP($nip, $nama_perguruan)
{
    $perguruanTinggiList = getPerguruanTinggiFromFile();
    foreach ($perguruanTinggiList as &$perguruanTinggi) {
        if ($perguruanTinggi['nip'] === $nip) {
            $perguruanTinggi['nama_perguruan'] = $nama_perguruan;
            break;
        }
    }
    savePerguruanTinggiToFile($perguruanTinggiList);
}

// Fungsi untuk mengubah data nilai akreditasi berdasarkan NIP di dalam file txt
function editNilaiAkreditasiByNIP($nip, $nilai_akreditasi)
{
    $nilaiAkreditasiList = getNilaiAkreditasiFromFile();
    foreach ($nilaiAkreditasiList as &$nilaiAkreditasi) {
        if ($nilaiAkreditasi['nip'] === $nip) {
            $nilaiAkreditasi['nilai_akreditasi'] = $nilai_akreditasi;
            break;
        }
    }
    saveNilaiAkreditasiToFile($nilaiAkreditasiList);
}