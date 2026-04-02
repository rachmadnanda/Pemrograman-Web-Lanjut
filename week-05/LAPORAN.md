# Laporan Praktikum Pemrograman Web Lanjut

**Topik:** Instalasi Filament PHP v4, CRUD Resource, dan Implementasi Relasi Database

## Deskripsi Proyek

Praktikum ini bertujuan untuk membangun sistem admin panel modern menggunakan Laravel 11 dan Filament PHP v4. Fokus utama meliputi proses instalasi, pembuatan fitur CRUD (Create, Read, Update, Delete) otomatis, serta pengelolaan relasi antar tabel database untuk entitas Kategori dan Postingan.

## Persiapan Lingkungan (Requirements)

Sebelum memulai, pastikan sistem memenuhi spesifikasi minimum berikut:

- PHP: $\geq$ 8.2
- Laravel: Version 11
- Tailwind CSS: $\geq$ 4.0
- Database: MySQL atau SQLite

## Langkah-Langkah Praktikum

### 1. Jobsheet 1: Instalasi dan Setup Dasar

Langkah awal adalah menyiapkan kerangka kerja Laravel dan mengintegrasikan Filament sebagai admin panel utama.

#### Instalasi Laravel

Membuat proyek baru dengan nama PraktikumPWL.

```bash
composer create-project laravel/laravel PraktikumPWL
cd PraktikumPWL
```

#### Konfigurasi Database

Mengatur file `.env` untuk menghubungkan aplikasi ke MySQL.

```
DB_CONNECTION=mysql
DB_DATABASE=Filament2026
DB_USERNAME=root
DB_PASSWORD=
```

#### Instalasi Filament

Menambahkan paket Filament v4 dan memasang Panel Builder.

```bash
composer require filament/filament:"^4.0" -W
php artisan filament:install --panels
```

#### Membuat User Admin

Membuat akun kredensial untuk masuk ke dashboard.

```bash
php artisan make:filament-user
# Name: Admin User
# Email: admin@gmail.com
# Password: (Sesuai input Anda)
```

### 2. Jobsheet 2: CRUD Resource User

Menggunakan fitur Resource Filament untuk mengelola data user secara otomatis tanpa menulis banyak kode manual.

#### Generate Resource

Perintah ini akan membuat file Resource utama, Pages, dan Schemas.

```bash
php artisan make:filament-resource User
```

#### Modifikasi Form Schema

Mengatur inputan pada file `UserForm.php`.

```php
// Lokasi: app/Filament/Admin/Resources/Users/Schemas/UserForm.php
public static function configure(Schema $schema): Schema {
    return $schema->components([
        TextInput::make('name')->required()->maxLength(255),
        TextInput::make('email')->email()->required()->maxLength(255),
        TextInput::make('password')->password()->required(),
    ]);
}
```

#### Modifikasi Table Schema

Menampilkan kolom data pada file `UsersTable.php`.

```php
// Lokasi: app/Filament/Admin/Resources/Users/Tables/UsersTable.php
public static function configure(Table $table): Table {
    return $table->columns([
        TextColumn::make('name')->searchable()->sortable(),
        TextColumn::make('email')->searchable()->sortable(),
    ]);
}
```

#### Kustomisasi Ikon

Mengubah ikon navigasi sidebar menggunakan Heroicons.

```php
protected static ?string $navigationIcon = 'heroicon-o-user-group';
```

### 3. Jobsheet 3: Migration, Model, dan Relasi

Membangun struktur database yang lebih kompleks dengan relasi One-to-Many antara Kategori dan Postingan.

#### Migration Category & Post

Menentukan struktur tabel melalui file migrasi.

```php
// Migration Categories
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});

// Migration Posts (dengan Foreign Key)
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content');
    $table->boolean('is_published')->default(false);
    $table->timestamps();
});
```

#### Eloquent Relationship

Mendefinisikan relasi pada file `Model Post.php`.

```php
// Lokasi: app/Models/Post.php
protected $fillable = ['category_id', 'title', 'slug', 'content', 'is_published'];

public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}
```

## Analisis & Diskusi Materi

- **Konsep Resource:** Resource adalah jantung dari Filament yang secara otomatis memetakan Model Laravel ke antarmuka admin yang lengkap (List, Create, Edit, Delete).

- **Form vs Table Builder:** Form Builder menangani input data pengguna (seperti TextInput), sedangkan Table Builder menangani presentasi data dari database (seperti TextColumn).

- **Integritas Data:** Penggunaan `cascadeOnDelete()` pada relasi database memastikan bahwa jika sebuah kategori dihapus, seluruh postingan terkait juga terhapus, mencegah adanya data sampah (orphan data).

- **Otomatisasi Slug:** Dengan Filament, kita bisa membuat slug secara reaktif dari input judul menggunakan metode `live(onBlur: true)` dan `afterStateUpdated`.

## Kesimpulan

Praktikum ini berhasil mengimplementasikan:

- Instalasi Laravel 11 dan Filament v4 dengan sukses.
- Konfigurasi database MySQL dan eksekusi migrasi tabel.
- Pembuatan User Admin dan Resource CRUD untuk entitas User.
- Pemahaman dasar mengenai Form Builder, Table Builder, dan sistem navigasi panel.
