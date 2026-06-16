# Laporan Praktikum - Week 14 (Filament Relations)

Nama : Rachmad Febriananda
NIM : 244107020095
Kelas : TI-2F  
Link Commit : https://github.com/rachmadnanda/Pemrograman-Web-Lanjut/commit/5c2f07d61f2718fe486afdf004bdf9c3a35d5235

## A. Langkah Praktikum (Implementasi Relation Manager)

Berikut adalah tahapan implementasi relasi menggunakan Filament:

### 1. Persiapan Model (Relationship)
Menambahkan relasi pada model `Category` dan `Post` agar Filament dapat mengenali hubungan antar tabel.

**File: `app/Models/Category.php`**
```php
public function posts()
{
    return $this->hasMany(Post::class);
}
```

**File: `app/Models/Post.php`**
```php
public function category()
{
    return $this->belongsTo(Category::class);
}
```

### 2. Membuat Relation Manager
Menjalankan perintah Artisan untuk membuat class Relation Manager yang akan menampilkan daftar Posting di dalam halaman Kategori.
```bash
php artisan make:filament-relation-manager CategoryResource posts title
```

### 3. Registrasi pada Resource Utama
Mendaftarkan `PostsRelationManager` agar muncul sebagai tab di halaman edit Kategori.

**File: `app/Filament/Resources/Categories/CategoryResource.php`**
```php
public static function getRelations(): array
{
    return [
        RelationManagers\PostsRelationManager::class,
    ];
}
```

### 4. Konfigurasi Form dan Table pada Relation Manager
Menyesuaikan tampilan form dan tabel di dalam Relation Manager dengan merujuk pada skema `PostForm` dan `PostsTable`.

**File: `app/Filament/Resources/Categories/RelationManagers/PostsRelationManager.php`**
```php
public function form(Schema $schema): Schema
{
    return PostForm::configure($schema);
}

public function table(Table $table): Table
{
    return PostsTable::configure($table)
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ]);
}
```

### 5. Optimasi Fitur Searchable
Menambahkan fitur pencarian pada dropdown relasi dan kolom tabel untuk memudahkan manajemen data dalam jumlah besar.

**File: `app/Filament/Resources/Posts/Schemas/PostForm.php`**
```php
Select::make("category_id")
    ->relationship("category", "name")
    ->required()
    ->searchable()
    ->preload(),
```

**File: `app/Filament/Resources/Posts/Tables/PostsTable.php`**
```php
TextColumn::make('title')->searchable()->sortable(),
TextColumn::make('slug')->searchable()->sortable(),
TextColumn::make('category.name')->searchable()->sortable(),
```

## B. Analisis & Diskusi

1. **Apa kegunaan utama dari Relation Manager di Filament?**
   Relation Manager memungkinkan kita untuk mengelola data dari model yang berelasi (misal: Posts milik sebuah Category) secara langsung di dalam satu halaman Resource utama. Ini menghilangkan kebutuhan untuk berpindah-pindah menu navigasi, sehingga proses manajemen data menjadi lebih cepat dan terorganir.

2. **Kapan sebaiknya kita menggunakan searchable() pada komponen Select?**
   `searchable()` sangat disarankan digunakan ketika data dalam tabel relasi berjumlah banyak (misal ratusan atau ribuan data). Tanpa fitur ini, browser akan memuat semua data ke dalam dropdown yang dapat menyebabkan kinerja aplikasi melambat dan menyulitkan pengguna dalam mencari item yang spesifik.

3. **Bagaimana cara kerja TextColumn::make('category.name') dalam melakukan pencarian?**
   Saat kita menambahkan `->searchable()` pada kolom relasi (menggunakan notasi titik seperti `category.name`), Filament secara otomatis melakukan join atau kueri tambahan ke tabel relasi. Pencarian dilakukan melalui kueri SQL `WHERE LIKE` pada kolom target di tabel relasi tersebut.

4. **Apa keuntungan memisahkan Form dan Table ke dalam file Schemas tersendiri?**
   Pemisahan ini (seperti `PostForm` dan `PostsTable`) mengikuti prinsip *Single Responsibility*. Kode menjadi lebih bersih, mudah dibaca, dan yang terpenting adalah *Reusable* (dapat digunakan kembali). Contohnya, kita bisa menggunakan skema yang sama baik di `PostResource` utama maupun di `PostsRelationManager` tanpa menulis ulang kode yang sama.
