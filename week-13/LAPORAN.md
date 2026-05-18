# **Laporan Praktikum Pemrograman Web Lanjut**

**Pertemuan 13 \- Implementasi Table Actions & Custom Action di Filament**

**Nama : Rachmad Febriananda**

**NIM : 244107020095**

**Kelas : TI-2F**

## **A. Tujuan Praktikum**

Setelah mengikuti praktikum ini, mahasiswa diharapkan mampu:

1. Menambahkan Record Actions pada tabel Filament.
2. Menggunakan predefined actions (Edit, Delete, Replicate).
3. Membuat custom action pada tabel.
4. Mengupdate data langsung dari tabel tanpa masuk ke halaman edit.
5. Menambahkan label dan icon pada action.
6. Memahami konsep callback/action function pada Filament.

---

## **B. Langkah-Langkah Praktikum**

### **1\. Menambahkan Delete Action**

Secara default, tombol Delete hanya tersedia di dalam halaman edit. Kita dapat menambahkannya langsung di baris tabel agar lebih efisien.

1. Buka file PostsTable.php .
2. Pastikan mengimpor class DeleteAction: use Filament\\Actions\\DeleteAction; (atau use Filament\\Tables\\Actions\\DeleteAction; menyesuaikan namespace tabel).
3. Cari bagian method \-\>recordActions(\[\]) dan tambahkan DeleteAction::make() di dalamnya .

```
PHP

\-\>recordActions(\[
    EditAction::make(),
    DeleteAction::make(),
\])
```

**Hasil:** Tombol Delete muncul langsung di tabel. Saat diklik, akan muncul _confirmation dialog_, dan jika disetujui, data akan terhapus tanpa perlu masuk ke halaman form edit terlebih dahulu .

### **2\. Menambahkan Replicate (Copy) Action**

Filament juga menyediakan _predefined action_ untuk menduplikasi data yang sudah ada .

1. Impor class ReplicateAction di bagian atas file.
2. Tambahkan ReplicateAction::make() ke dalam array \-\>recordActions(\[\]) .

```
PHP

\-\>recordActions(\[
    ReplicateAction::make(),
    EditAction::make(),
    DeleteAction::make(),
\])
```

**Hasil:** Tombol Replicate akan muncul. Saat pengguna mengkliknya, _record_ atau baris data baru akan langsung dibuat menyalin data dari baris yang dipilih.

### **3\. Membuat Custom Action (Contoh: Ubah Status Publish)**

Selain action bawaan, kita bisa membuat tombol custom dengan logika kita sendiri, misalnya untuk _toggle_ status publish .

1. Tambahkan Action::make() baru ke dalam recordActions dan berikan nama serta label .
2. Tambahkan Schema berupa Checkbox untuk form input pop-up .
3. Tambahkan method \-\>action() berisi fungsi _callback/closure_ untuk melakukan update nilai published ke dalam database .
4. (Opsional) Tambahkan icon agar UI lebih menarik menggunakan \-\>icon() .

```
PHP

use Filament\\Tables\\Actions\\Action;
use Filament\\Forms\\Components\\Checkbox;

// Di dalam array recordActions:
Action::make('status')
    \-\>label('Status Change')
    \-\>icon('heroicon-o-check-circle')
    \-\>schema(\[
        Checkbox::make('published')
            \-\>default(fn($record): bool \=\> $record\-\>published),
    \])
    \-\>action(function ($record, $data) {
        $record\-\>update(\['published' \=\> $data\['published'\]\]);
    }),
```

---

## **C. Analisis & Diskusi**

**1\. Mengapa action di tabel lebih efisien dibanding halaman edit?**

Action di tabel (seperti hapus atau ubah status) sangat meningkatkan _User Experience_ (UX) karena mengurangi jumlah klik dan navigasi halaman. Pengguna dapat mengeksekusi operasi sederhana secara langsung dan cepat tanpa harus memuat seluruh _form builder_ di halaman edit terlebih dahulu.

**2\. Apa perbedaan predefined action dan custom action?**

- **Predefined Action**: Adalah action bawaan yang sudah disediakan oleh Filament (seperti CreateAction, EditAction, DeleteAction, ReplicateAction) . Konfigurasi UI dan logika internalnya sudah dibuat secara otomatis di belakang layar.
- **Custom Action**: Adalah action yang dibangun dari awal menggunakan Action::make(). Kita memiliki kebebasan penuh untuk mendefinisikan label, ikon, form _schema_ yang digunakan, hingga logika eksekusi (query database, pemanggilan API eksternal, dll.) menggunakan closure \-\>action().

**3\. Bagaimana cara menambahkan validasi dalam custom action?**

Karena _custom action_ di Filament menggunakan komponen _Form Builder_ yang sama (pada bagian \-\>schema()), kita bisa langsung merangkaikan (_chaining_) metode validasi bawaan Filament pada input tersebut. Contohnya, jika menggunakan TextInput, kita bisa menambahkan \-\>required(), \-\>email(), atau \-\>maxLength(255) langsung pada definisi inputnya sebelum method \-\>action() dijalankan.

**4\. Kapan kita menggunakan Replicate?**

Action Replicate sangat berguna ketika pengguna perlu memasukkan data baru yang memiliki kemiripan nilai hampir 100% dengan data yang sudah ada di database. Alih-alih mengisi form panjang dari awal, pengguna cukup mereplikasi data lama, lalu mengubah satu atau dua _field_ yang berbeda saja. Ini sangat mempercepat proses _data entry_.
