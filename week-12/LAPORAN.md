**Laporan Praktikum Pemrograman Web Lanjut**  
**Pertemuan 12 \- Implementasi Toggle Column pada Table Filament**

**Nama : Rachmad Febriananda**

**NIM : 244107020095**

**Kelas : TI-2F**  

Link Commit : https://github.com/rachmadnanda/Pemrograman-Web-Lanjut/commit/084a5a37b404755713fdd212d926ffb962c6277e

## **A. Tujuan Praktikum**

Setelah mengikuti praktikum ini, mahasiswa diharapkan mampu:

1. Menambahkan kolom baru pada tabel Filament.
2. Menggunakan IconColumn untuk boolean.
3. Mengaktifkan fitur toggleable() pada kolom.
4. Mengatur kolom agar tersembunyi secara default.
5. Memahami cara kerja penyimpanan preferensi kolom (session).

---

## **B. Langkah-Langkah Praktikum**

### **1\. Menambahkan Kolom Baru**

Sebelum menerapkan toggle, kita perlu menambahkan beberapa kolom tambahan agar tabel memuat lebih banyak informasi.

1. Buka file PostsTable.php .
2. Tambahkan kolom **ID** dan **Tags** menggunakan TextColumn di dalam method columns() .
3. Tambahkan kolom **Published** yang merepresentasikan data boolean. Pastikan mengimpor class IconColumn di bagian atas file .

```
PHP

use Filament\\Tables\\Columns\\IconColumn;

// Di dalam array method columns():
TextColumn::make('id')
    \-\>label('ID')
    \-\>sortable(),

TextColumn::make('tags')
    \-\>label('Tags'),

IconColumn::make('published')
    \-\>boolean()
    \-\>label('Published'),
```

### **2\. Mengaktifkan Toggle Column**

Agar pengguna dapat memilih kolom mana yang ingin ditampilkan, kita perlu menambahkan method \-\>toggleable().

1. Tambahkan \-\>toggleable() pada kolom-kolom yang ingin diatur visibilitasnya, seperti kolom ID .
2. Lakukan hal yang sama (menambahkan \-\>toggleable()) pada kolom lain seperti Title, Slug, Category, Color, Image, dan Created At .

```
PHP

TextColumn::make('id')
    \-\>label('ID')
    \-\>toggleable(),
```

**Hasil:** Akan muncul icon pengaturan kolom di pojok kanan atas tabel. Pengguna dapat mencentang atau menghilangkan centang untuk menampilkan atau menyembunyikan kolom .

### **3\. Menyembunyikan Kolom Secara Default**

Untuk kolom yang datanya tidak terlalu prioritas, kita bisa mengatur agar kolom tersebut tidak langsung tampil saat tabel pertama kali dimuat.

1. Gunakan parameter isToggledHiddenByDefault: true di dalam method toggleable() .
2. Terapkan pada kolom pendukung seperti **ID** dan **Tags** .

```
PHP

TextColumn::make('tags')
    \-\>label('Tags')
    \-\>toggleable(isToggledHiddenByDefault: true),
```

**Hasil:** Kolom Tags dan ID tidak akan langsung tampil di tabel secara default, tetapi pengguna tetap dapat mengaktifkannya sewaktu-waktu melalui menu toggle . Konfigurasi kolom yang dipilih pengguna ini akan otomatis disimpan di dalam session oleh Filament .

---

## **C. Analisis & Diskusi**

**1\. Mengapa toggle column penting pada admin panel?** Toggle column sangat penting karena dalam sistem dengan banyak data, menampilkan seluruh kolom secara bersamaan akan membuat antarmuka tabel terlihat sangat penuh dan kurang rapi . Fitur ini memberikan fleksibilitas kepada pengguna untuk menyesuaikan antarmuka sesuai preferensi mereka dan hanya melihat informasi yang benar-benar mereka butuhkan .

**2\. Apa perbedaan toggleable() biasa dengan isToggledHiddenByDefault?**

- **toggleable()**: Membuat visibilitas suatu kolom dapat diubah-ubah, namun secara bawaan (default) kolom tersebut dalam keadaan aktif atau tampil di tabel .
- **isToggledHiddenByDefault**: Kolom tersebut tetap memiliki opsi untuk ditampilkan atau disembunyikan, tetapi status awalnya saat halaman dimuat adalah disembunyikan (hidden) .

**3\. Mengapa preferensi kolom tetap tersimpan?** Filament secara otomatis menangani status visibilitas kolom dengan menyimpannya di dalam _session_ aplikasi . Karena tersimpan dalam session, saat pengguna berpindah ke halaman lain dan kembali lagi ke halaman tabel tersebut, konfigurasi atau preferensi kolom terakhir yang mereka pilih akan tetap bertahan.

**4\. Kapan sebaiknya kolom disembunyikan secara default?** Sebuah kolom sebaiknya disembunyikan secara default ketika memuat informasi tambahan (sekunder) yang jarang dicari saat melakukan pemindaian cepat, misalnya kolom Primary Key (ID), Metadata, atau Tags . Hal ini dilakukan agar tampilan tabel tetap bersih pada pandangan pertama, namun datanya tetap dapat diakses jika sewaktu-waktu pengguna ingin melakukan analisis yang lebih mendalam.
