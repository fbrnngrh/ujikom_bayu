## Aplikasi Pengelolaan Data Akreditasi Perguruan Tinggi

Aplikasi ini adalah sebuah aplikasi berbasis web sederhana untuk pengelolaan data akreditasi perguruan tinggi. Aplikasi ini menggunakan PHP native dan menyimpan data dalam file penyimpanan txt/csv.

### Fitur Aplikasi

1. **Beranda**
   - Halaman beranda menampilkan statistik sederhana data perguruan tinggi dengan chart berdasarkan nilai akreditasi dan tabel statistik peringkat akreditasi.

2. **Kelola Data Perguruan Tinggi**
   - Pada halaman ini, Anda dapat menambahkan data perguruan tinggi baru dengan mengisi formulir yang disediakan.
   - Anda juga dapat melihat daftar seluruh perguruan tinggi yang telah terdaftar beserta informasi peringkat akreditasi.

3. **Kelola Nilai Akreditasi**
   - Pada halaman ini, Anda dapat menambahkan data nilai akreditasi perguruan tinggi, termasuk nomer induk perguruan tinggi, nama, nilai akreditasi, dan peringkat akreditasi.
   - Anda juga dapat melihat daftar seluruh data nilai akreditasi yang telah terdaftar.

4. **Pencarian Data Perguruan Tinggi**
   - Pada halaman beranda, terdapat fitur pencarian data perguruan tinggi berdasarkan nama perguruan tinggi.
   - Masukkan kata kunci nama perguruan tinggi pada kolom pencarian, kemudian klik tombol "Cari" untuk menampilkan hasil pencarian.

### Penyimpanan Data

Data perguruan tinggi dan nilai akreditasi disimpan dalam file penyimpanan `perguruan_tinggi.txt`. Setiap baris dalam file tersebut berisi data perguruan tinggi dalam format JSON. Contoh format data JSON:

```
{"nomer_induk":"123","nama":"Politeknik Negeri Tanah Laut","nilai_akreditasi":"400","peringkat_akreditasi":"A","tanggal_jam":"2023-07-20 03:59:23"}
{"nomer_induk":"12411213","nama":"Politelknik Negeri Batam","nilai_akreditasi":"370","peringkat_akreditasi":"A","tanggal_jam":"2023-07-20 04:02:48"}
...
```

### Cara Menjalankan Aplikasi

1. Pastikan Anda memiliki web server dan PHP yang sudah terinstall di komputer Anda.

2. Clone repositori ini ke direktori web server Anda.

3. Buat file `perguruan_tinggi.txt` untuk menyimpan data perguruan tinggi.

4. Akses aplikasi melalui web browser dengan mengunjungi URL `http://localhost/nama_folder_aplikasi/index.php`.

5. Anda sekarang dapat menggunakan aplikasi untuk mengelola data perguruan tinggi dan nilai akreditasi.

### Catatan

- Pastikan direktori `assets/css` dan `assets/js` memiliki file `style.css` dan `script.js` yang sesuai dengan desain dan fungsi aplikasi.
- Pastikan semua file terkait dengan aplikasi sudah berada di tempat yang tepat dan nama file dan direktori sudah sesuai.

Selamat menggunakan Aplikasi Pengelolaan Data Akreditasi Perguruan Tinggi! Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk bertanya. Terima kasih!