# Laporan Praktikum Pemrograman Web Lanjut - Jobsheet 3

**Topik:** Migration, Seeder, DB Façade, Query Builder, dan Eloquent ORM

**Nama:** Rachmad Febriananda
**NIM:** 244107020095
**Kelas:** TI-2F

**Jobsheet** Migration, Seeder, DB Façade, Query Builder, dan Eloquent ORM

---

**Studi Kasus:** Wedbook (Sistem Manajemen Tamu Digital)

## Praktikum 1: Pengaturan Database

Berhasil membuat database `wedbook` di phpMyAdmin dan mengonfigurasi koneksinya pada file `.env` Laravel.
![Hasil Praktikum 1](./screenshots-wedbook/prak11.png)
![Hasil Praktikum 1.1](./screenshots-wedbook/prak12.png)

## Praktikum 2.1: Pembuatan File Migrasi Tanpa Relasi

Melakukan pembuatan file migrasi dasar untuk tabel `users` yang berdiri sendiri (tidak memiliki foreign key).
![Hasil Praktikum 2.1](./screenshots-wedbook/prak211.png)
![Hasil Praktikum 2.12](./screenshots-wedbook/prak212.png)
![Hasil Praktikum 2.13](./screenshots-wedbook/prak213.png)

## Praktikum 2.2: Pembuatan File Migrasi Dengan Relasi

Membuat rancangan tabel yang memiliki relasi (foreign key) yaitu tabel `events` dan `guests`, kemudian mengeksekusinya ke database menggunakan perintah migrate.
![Hasil Praktikum 2.2](./screenshots-wedbook/prak22.png)

## Praktikum 3: Seeder

Melakukan pengisian data awal (_dummy data_) secara otomatis ke dalam database menggunakan Seeder untuk tabel `users`, `events`, dan `guests`.
![Hasil Praktikum 3](./screenshots-wedbook/prak3.png)

## Praktikum 4: Implementasi DB Facade

Menerapkan operasi database menggunakan metode **DB Facade (Raw Query)** untuk mengeksekusi sintaks SQL murni dalam menampilkan data _Event_.
![Hasil Praktikum 4](./screenshots-wedbook/prak41.png)
![Hasil Praktikum 4.1](./screenshots-wedbook/prak42.png)

## Praktikum 5: Implementasi Query Builder

Menerapkan operasi database menggunakan fitur **Query Builder** bawaan Laravel yang lebih rapi untuk menampilkan daftar Tamu Undangan (_Guests_).
![Hasil Praktikum 5](./screenshots-wedbook/prak51.png)
![Hasil Praktikum 5.1](./screenshots-wedbook/prak52.png)

## Praktikum 6: Implementasi Eloquent ORM

Menerapkan pendekatan _Object-Relational Mapping_ (**Eloquent ORM**) dengan membuat Model khusus untuk mengambil dan menampilkan data Pengguna (_Users_) secara _object-oriented_.
![Hasil Praktikum 6](./screenshots-wedbook/prak61.png)
![Hasil Praktikum 6.1](./screenshots-wedbook/prak62.png)

---

_Laporan ini disusun untuk memenuhi tugas mata kuliah Pemrograman Web Lanjut._
