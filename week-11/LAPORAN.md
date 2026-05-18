# **Laporan Praktikum Pemrograman Web Lanjut**

**Pertemuan 11 \- Implementasi Search & Filter pada Table Filament**

**Nama : Rachmad Febriananda**

**NIM : 244107020095**

**Kelas : TI-2F**

## **A. Tujuan Praktikum**

Setelah mengikuti praktikum ini, mahasiswa diharapkan mampu:

1. Menambahkan fitur Search (Pencarian) pada tabel.
2. Menggunakan method searchable().
3. Membuat filter berdasarkan tanggal (Date Filter).
4. Membuat filter berdasarkan relasi (Select Filter).
5. Menambahkan query custom pada filter.
6. Menggabungkan fitur Search dan Filter secara bersamaan.

---

## **B. Langkah-Langkah Praktikum**

### **1\. Menambahkan Fitur Search pada Kolom**

Langkah pertama adalah menambahkan fungsionalitas pencarian teks agar pengguna dapat mencari data secara _real-time_.

1. Buka file PostsTable.php.
2. Pada method columns(), tambahkan method \-\>searchable() pada kolom yang ingin dijadikan acuan pencarian, yaitu title, slug, dan category.name .

PHP

TextColumn::make('title')  
 \-\>sortable()  
 \-\>searchable(),  
TextColumn::make('slug')  
 \-\>sortable()  
 \-\>searchable(),  
TextColumn::make('category.name')  
 \-\>sortable()  
 \-\>searchable(),

**Hasil:** Search bar akan otomatis muncul di atas tabel, dan kita dapat mencari data berdasarkan Title, Slug, maupun Category.

### **2\. Membuat Filter Berdasarkan Tanggal (Date Filter)**

Pencarian teks biasa kurang efektif untuk mencari tanggal, sehingga kita membutuhkan Filter khusus.

1. Tambahkan _use statement_ berikut di bagian atas file PostsTable.php:

PHP

use Filament\\Tables\\Filters\\Filter;  
use Filament\\Forms\\Components\\DatePicker;

2. Pada method \-\>filters(), buat filter baru untuk created_at dengan komponen DatePicker .
3. Tambahkan custom query menggunakan whereDate() agar filter benar-benar melakukan filtering data di database berdasarkan tanggal yang dipilih .

PHP

\-\>filters(\[  
 Filter::make('created_at')  
 \-\>label('Creation Date')  
 \-\>schema(\[  
 DatePicker::make('created_at')  
 \-\>label('Select Date:'),  
 \])  
 \-\>query(function ($query, $data) {  
            return $query\-\>when(  
                $data\['created\_at'\],  
                fn ($query, $date) \=\> $query\-\>whereDate('created_at', $date)  
 );  
 }),  
\])

### **3\. Membuat Filter Berdasarkan Relasi (Select Filter)**

Selain tanggal, kita juga bisa membuat dropdown filter untuk kategori menggunakan SelectFilter.

1. Tambahkan _use statement_ berikut:

PHP

use Filament\\Tables\\Filters\\SelectFilter;

2. Tambahkan SelectFilter di dalam array \-\>filters().
3. Gunakan method \-\>relationship() untuk menarik data kategori secara otomatis.

PHP

SelectFilter::make('category_id')  
 \-\>label('Category')  
 \-\>relationship('category', 'name')  
 \-\>preload(),

**Hasil:** Dropdown kategori akan muncul di menu filter, dan data otomatis disaring saat kategori dipilih.

---

C. Analisis & Diskusi

1\. Mengapa search tidak cocok untuk filter tanggal? Search dirancang untuk pencarian teks (string matching) secara _real-time_ yang menghasilkan kueri seperti LIKE %keyword%. Format tanggal di database (seperti YYYY-MM-DD HH:MM:SS) sulit dicocokkan hanya dengan mengetik teks bebas. Filter menggunakan UI khusus (seperti kalender) dan menjalankan logika kueri kondisi spesifik (kondisional eksak) yang jauh lebih presisi untuk data tanggal.

2\. Apa fungsi relationship() pada SelectFilter? Fungsi relationship('category', 'name') bertugas untuk memberi tahu Filament agar secara otomatis memuat (query) opsi dropdown filter dari tabel relasi. Filament akan mengambil semua data dari relasi model category dan menampilkan kolom name sebagai label opsinya di antarmuka pengguna.

3\. Mengapa kita perlu whereDate() pada query filter? Kolom created_at umumnya bertipe timestamp atau datetime yang menyimpan tanggal sekaligus waktu spesifik (contoh: 2026-02-28 14:36:12). Jika kita menggunakan where() biasa, pencarian hanya akan cocok jika jam, menit, dan detiknya juga sama persis. Method whereDate() mengabaikan komponen waktu dan memastikan pencocokan hanya dilakukan berdasarkan nilai harinya saja (contoh: 2026-02-28).

4\. Apa perbedaan searchable() dan filters()?

- **searchable():** Menyediakan satu kotak input global di atas tabel yang digunakan untuk pencarian teks secara _real-time_ lintas kolom (seperti mencocokkan title atau slug).
- **filters():** Menyediakan menu terstruktur berdasarkan form input khusus (seperti dropdown atau date picker) untuk menyaring data berdasarkan kondisi yang spesifik (seperti filter rentang waktu atau relasi kategori).
