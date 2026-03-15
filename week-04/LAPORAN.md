LAPORAN PRAKTIKUM JOBSHEET 4 \- PEMROGRAMAN WEB LANJUT  
NAMA: RACHMAD FEBRIANANDA  
NIM: 244107020095  
KELAS: TI-2F

Link Commit Terakhir Repository:

Praktikum 1  
![](screenshots/Screenshot%202026-03-08%20191852.png)  
Setelah kode diubah, yaitu menghapus password pada userModel dan menambahkan manager*tiga beserta passwordnya, pesan \_error* SQL (seperti _Field 'password' doesn't have a default value_) seperti gambar di bawah.  
![](screenshots/Screenshot%202026-03-08%20192130.png)  
Hal ini terjadi karena atribut password tidak lagi terdaftar di $fillable. Saat fungsi UserModel::create() dipanggil, Laravel membuang data password karena dianggap tidak mendapat izin masuk. Akibatnya, Laravel mencoba menyimpan data ke database tanpa password, dan database menolaknya. Ini membuktikan bahwa fitur keamanan mass assignment Laravel berfungsi.  
Praktikum 2.1  
![](screenshots/Screenshot%202026-03-08%20203529.png)  
Ketika dijalankan, halaman web sekarang hanya menampilkan **satu baris data** di dalam tabel, yaitu data pengguna dengan ID 1\. Hal ini terjadi karena kita tidak lagi menggunakan `UserModel::all()` (yang memanggil kumpulan model/semua data), melainkan menggunakan method `UserModel::find(1)` yang mengembalikan satu contoh model tunggal berdasarkan _primary key_.  
![](screenshots/Screenshot%202026-03-08%20204309.png)  
Hasilnya akan menampilkan satu baris data pengguna. Kode `where('level_id', 1)->first()` memerintahkan Laravel untuk mencari semua data dengan `level_id` bernilai 1, lalu method `first()` memastikan yang diambil **hanya baris pertama** dari hasil pencarian tersebut.  
![](screenshots/Screenshot%202026-03-08%20204411.png)  
Hasil di layar tidak akan berubah. Fungsi `firstWhere('level_id', 1)` ini sebenarnya adalah "jalan pintas" (alternatif) dari `where('level_id', 1)->first()` yang baru saja kamu coba di Langkah 4\. Kodenya lebih pendek dan rapi, tapi fungsinya 100% sama untuk mengambil model pertama yang cocok dengan batasan kueri.

**Langkah 9,** halaman web akan tetap muncul karena user dengan ID 1 **ada** di database. Tapi, kolom ID dan ID Level Pengguna di tabel akan kosong.  
![](screenshots/Screenshot%202026-03-08%20212455.png)  
Karena di kode atas kita membatasi kolom yang diambil hanya `['username', 'nama']`, jadi data ID dan level tidak ikut terpanggil. Ini normal dan membuktikan kodenya berjalan sesuai perintah.

Pada langkah 11, kali ini, layar akan berubah menjadi halaman **404 Not Found** bawaan Laravel.  
![](screenshots/Screenshot%202026-03-08%20212711.png)  
Ini terjadi karena sistem tidak bisa menemukan user dengan ID 20 di dalam database, sehingga sistem otomatis menjalankan perintah `abort(404)` yang ada di dalam _function_.

Praktikum 2.2  
![](screenshots/Screenshot%202026-03-08%20215525.png)  
Akan muncul data user dengan ID 1 (karena datanya memang ada di database) dan kodenya jauh lebih simpel.  
Kemudian akan kita tes kalau datanya benar-benar tidak ada.  
![](screenshots/Screenshot%202026-03-08%20215716.png)  
Layar akan otomatis berubah menjadi halaman **404 Not Found** (atau ModelNotFoundException). Ini membuktikan bahwa `firstOrFail()` otomatis menggagalkan proses dan memunculkan _error_ karena _username_ `manager9` memang tidak pernah kita buat di database

Praktikum 2.3  
![](screenshots/Screenshot%202026-03-08%20220214.png)  
Layar _browser_ akan blank dan memunculkan angka (hasil hitungannya).

Karena yang dikirim dari _controller_ sekarang cuma angka biasa (bukan data objek _user_), kita harus menyesuaikan file Blade-nya.  
![](screenshots/Screenshot%202026-03-08%20220355.png)  
![](screenshots/Screenshot%202026-03-08%20220451.png)  
Layar akan menampilkan tabel kecil dengan judul "Jumlah Pengguna" dan angka di bawahnya. Ini membuktikan kita berhasil melempar hasil perhitungan _aggregate_ `count()` dari _controller_ ke _view_.

Praktikum 2.4  
![](screenshots/Screenshot%202026-03-08%20223352.png)  
Layar akan memunculkan data user `manager`. Ini karena data `manager` memang sudah ada, jadi `firstOrCreate` tinggal memanggilnya.

Selanjutkan, mengetes `firstOrCreate` dengan Data Baru  
![](screenshots/Screenshot%202026-03-08%20223901.png)  
Halaman web akan memunculkan data `manager22`. Selanjutnya kita **buka phpMyAdmin** dan cek tabel `m_user`. Ssekarang ada baris baru dengan _username_ `manager22`.Ini bukti bahwa `firstOrCreate` langsung mengeksekusi penyimpanan ke _database_ secara otomatis.  
![](screenshots/Screenshot%202026-03-08%20224054.png)

Selanjutnya mengetes `firstOrNew` dengan Data Lama.  
![](screenshots/Screenshot%202026-03-08%20224400.png)  
Layar akan menampilkan data `manager`. Sama persis fungsinya seperti `firstOrCreate` kalau datanya memang sudah ada di database.

Selanjutnya, mengetes `firstOrNew` dengan Data Baru (Tanpa Save).  
![](screenshots/Screenshot%202026-03-08%20224459.png)  
Tabel memunculkan data `manager33`. **Tapi ketika dibuka di** phpMyAdmin dan dicek tabel `m_user`. Data `manager33` **tidak ada** di sana. Inilah bedanya dengan `firstOrCreate`. Data ini hanya numpang lewat di tampilan saja, tapi belum masuk ke database.  
![](screenshots/Screenshot%202026-03-08%20224617.png)

Selanjutnya, menambahkan perintah `save()`  
![](screenshots/Screenshot%202026-03-08%20225017.png)  
![](screenshots/Screenshot%202026-03-08%20225035.png)  
Halaman web akan tetap menampilkan manager33. Tapi sekarang, ketika dibuka pada phpMyAdmin dan refresh, baris manager33 akhirnya resmi masuk dan tercatat di database.

Praktikum 2.5  
![](screenshots/Screenshot%202026-03-08%20225508.png)  
Layar akan menjadi hitam dan memunculkan tulisan `true`. Hal ini membuktikan bahwa fungsi `isDirty()` mendeteksi adanya perubahan nilai pada atribut `username` (dari `manager55` menjadi `manager56`) yang **belum** di-`save()` ke dalam _database_.

Sekarang mengetes fungsi `wasChanged()`. Fungsi ini baru akan aktif _setelah_ perintah `save()` dieksekusi.  
![](screenshots/Screenshot%202026-03-09%20080138.png)  
Layar akan kembali memunculkan tulisan `true`. Hal ini terjadi karena kita memanggil `wasChanged('username')` tepat setelah perintah `$user->save()`. Sistem mendeteksi bahwa pada siklus tersebut, kolom `username` memang benar-benar mengalami perubahan dan berhasil disimpan ke _database_.

Praktikum 2.6  
![](screenshots/Screenshot%202026-03-09%20080537.png)  
Saat disimpan dan di-_refresh_, halaman `/user` sekarang menampilkan tabel berisi seluruh pengguna dari _database_, lengkap dengan tombol aksi "Ubah" dan "Hapus" yang (sementara) belum berfungsi karena _route_\-nya belum dibuat.  
Selanjutnya membuat fungsi supaya tombol "+ Tambah User" bisa dipakai.  
![](screenshots/Screenshot%202026-03-09%20080823.png)  
Mendaftarkan route baru.  
![](screenshots/Screenshot%202026-03-09%20082102.png)  
Menambahkan Logika di Controller.  
![](screenshots/Screenshot%202026-03-09%20082146.png)  
![](screenshots/Screenshot%202026-03-09%20082303.png)  
Ketika _browser_ dibuka, halaman `/user`, klik link "+ Tambah User". Kamu akan diarahkan ke form. Setelah datanya terisi, bisa klik "Simpan".  
![](screenshots/Screenshot%202026-03-09%20082359.png)  
Aplikasi akan memproses data menggunakan `UserController@tambah_simpan`, menyimpannya ke MySQL, lalu otomatis kembali ke halaman awal dan data yang baru akan muncul di tabel terbawah.  
Selanjutnya akan diterapkan juga pada tombol ubah dan hapus.  
![](screenshots/Screenshot%202026-03-09%20083543.png)  
Ketika diklik salah satu tombol "Ubah", maka akan dibawa ke form yang sudah **terisi otomatis** dengan data lama. Sistem akan memprosesnya pakai fungsi `save()` dan menimpa data lama di _database_. Saat dialihkan kembali ke halaman utama, username sudah berubah  
![](screenshots/Screenshot%202026-03-09%20083715.png)  
![](screenshots/Screenshot%202026-03-09%20083729.png)

Begitupun untuk hapus.  
Ketika dibuka _browser_ halaman `/user` dan diklik tombol "Hapus" pada salah satu data percobaan (misal _manager33_). Aplikasi akan menangkap ID tersebut, mencari barisnya di _database_, dan menghapusnya dengan metode `delete()`. Setelah itu otomatis kembali ke halaman utama, dan data _manager33_ sudah hilang dari tabel.  
![](screenshots/Screenshot%202026-03-09%20083927.png)

Praktikum 2.7  
![](screenshots/Screenshot%202026-03-09%20084626.png)  
Karena ada `dd($user)`, layar akan hitam dan menampilkan struktur data (_Collection_). Kalau diklik tanda panah (`▶`) di datanya dan membuka bagian `relations`, dan akan ada data dari tabel level.  
![](screenshots/Screenshot%202026-03-09%20084806.png)  
Sekarang tabelnya memiliki dua kolom baru yang menampilkan **Kode Level** (misal: ADM / MNG) dan **Nama Level** (misal: Administrator / Manager) secara langsung . Aplikasi menjadi jauh lebih mudah dibaca oleh pengguna biasa.
