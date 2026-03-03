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
![Hasil Praktikum 1](./screenshots-wedbook/Screenshot 2026-03-03 172007.png)
![Hasil Praktikum 1.1](./screenshots-wedbook/Screenshot 2026-03-03 171659.png)

## Praktikum 2.1: Pembuatan File Migrasi Tanpa Relasi

Melakukan pembuatan file migrasi dasar untuk tabel `users` yang berdiri sendiri (tidak memiliki foreign key).
![Hasil Praktikum 2.1](./screenshots-wedbook/Screenshot 2026-03-03 172324.png)
![Hasil Praktikum 2.12](./screenshots-wedbook/Screenshot 2026-03-03 172432.png)
![Hasil Praktikum 2.13](./screenshots-wedbook/Screenshot 2026-03-03 172441.png)

## Praktikum 2.2: Pembuatan File Migrasi Dengan Relasi

Membuat rancangan tabel yang memiliki relasi (foreign key) yaitu tabel `events` dan `guests`, kemudian mengeksekusinya ke database menggunakan perintah migrate.
![Hasil Praktikum 2.2](./screenshots-wedbook/Screenshot 2026-03-03 172528.png)

## Praktikum 3: Seeder

Melakukan pengisian data awal (_dummy data_) secara otomatis ke dalam database menggunakan Seeder untuk tabel `users`, `events`, dan `guests`.
![Hasil Praktikum 3](./screenshots-wedbook/Screenshot 2026-03-03 172703.png)

## Praktikum 4: Implementasi DB Facade

Menerapkan operasi database menggunakan metode **DB Facade (Raw Query)** untuk mengeksekusi sintaks SQL murni dalam menampilkan data _Event_.
![Hasil Praktikum 4](./screenshots-wedbook/Screenshot 2026-03-03 172901.png)
![Hasil Praktikum 4.1](./screenshots-wedbook/Screenshot 2026-03-03 173251.png)

## Praktikum 5: Implementasi Query Builder

Menerapkan operasi database menggunakan fitur **Query Builder** bawaan Laravel yang lebih rapi untuk menampilkan daftar Tamu Undangan (_Guests_).
![Hasil Praktikum 5](./screenshots-wedbook/Screenshot 2026-03-03 173033.png)
![Hasil Praktikum 5.1](./screenshots-wedbook/Screenshot 2026-03-03 173301.png)

## Praktikum 6: Implementasi Eloquent ORM

Menerapkan pendekatan _Object-Relational Mapping_ (**Eloquent ORM**) dengan membuat Model khusus untuk mengambil dan menampilkan data Pengguna (_Users_) secara _object-oriented_.
![Hasil Praktikum 6](./screenshots-wedbook/Screenshot 2026-03-03 173204.png)
![Hasil Praktikum 6.1](./screenshots-wedbook/Screenshot 2026-03-03 173311.png)

---

_Laporan ini disusun untuk memenuhi tugas mata kuliah Pemrograman Web Lanjut._
