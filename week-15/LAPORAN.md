# Laporan Praktikum - Week 15 (Filament Many-to-Many Relations)

Nama : Rachmad Febriananda
NIM : 244107020095
Kelas : TI-2F  
Link Commit : https://github.com/rachmadnanda/Pemrograman-Web-Lanjut/commit/3da6c8c4b00e6dcb55eff84e90fcde4291e4e2fa

## A. Langkah Praktikum (Implementasi Many-to-Many Relationship)

Berikut adalah tahapan implementasi relasi Many-to-Many antara Post dan Tag menggunakan Filament:

### 1. Persiapan Database (Migration)

Membuat model `Tag` beserta migrasinya, serta membuat tabel pivot `post_tag` untuk menghubungkan kedua model tersebut.

**File: `database/migrations/xxxx_xx_xx_create_tags_table.php`**

```php
Schema::create('tags', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});
```

**File: `database/migrations/xxxx_xx_xx_create_post_tag_table.php`**

```php
Schema::create('post_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->cascadeOnDelete();
    $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```

### 2. Definisi Relasi pada Model

Menambahkan relasi `belongsToMany` pada kedua model.

**File: `app/Models/Post.php`**

```php
public function tags()
{
    return $this->belongsToMany(Tag::class);
}
```

**File: `app/Models/Tag.php`**

```php
public function posts()
{
    return $this->belongsToMany(Post::class);
}
```

### 3. Modifikasi Form Postingan

Mengubah input tags dari `TagsInput` menjadi komponen `Select` yang mendukung relasi Many-to-Many dengan fitur pencarian dan pembuatan opsi baru secara langsung.

**File: `app/Filament/Resources/Posts/Schemas/PostForm.php`**

```php
Select::make('tags')
    ->multiple()
    ->relationship('tags', 'name')
    ->preload()
    ->createOptionForm([
        TextInput::make('name')
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', \Str::slug($state)) : null),
        TextInput::make('slug')
            ->disabled()
            ->dehydrated()
            ->required()
            ->unique(Tag::class, 'slug', ignoreRecord: true),
    ]),
```

### 4. Membuat Relation Manager untuk Tag

Membuat `TagsRelationManager` agar tag dapat dikelola secara mandiri di dalam halaman edit Postingan.

**Command:**

```bash
php artisan make:filament-relation-manager PostResource tags name
```

**File: `app/Filament/Resources/Posts/PostResource.php`**

```php
public static function getRelations(): array
{
    return [
        RelationManagers\TagsRelationManager::class,
    ];
}
```

## B. Analisis & Diskusi

1. **Apa perbedaan utama antara One-to-Many dan Many-to-Many pada Filament?**
   Pada One-to-Many (seperti Category-Post), data anak hanya bisa merujuk ke satu induk. Namun pada Many-to-Many (seperti Post-Tag), satu postingan dapat memiliki banyak tag, dan satu tag yang sama dapat digunakan oleh banyak postingan melalui tabel perantara (pivot table).

2. **Apa fungsi dari method multiple() pada komponen Select Filament?**
   Method `multiple()` memungkinkan pengguna untuk memilih lebih dari satu nilai dalam satu kolom select. Dalam konteks relasi Many-to-Many, Filament secara otomatis akan menyimpan array nilai tersebut ke dalam tabel pivot yang telah ditentukan.

3. **Mengapa relasi Many-to-Many memerlukan tabel pivot?**
   Tabel pivot diperlukan untuk menghindari redundansi data dan memungkinkan hubungan silang antar baris di dua tabel yang berbeda tanpa harus menambahkan kolom baru di tabel utama setiap kali ada hubungan baru.

4. **Kapan kita menggunakan createOptionForm() pada Select relasi?**
   Kita menggunakannya ketika ingin memberikan User Experience yang lebih baik, di mana pengguna dapat menambahkan data referensi baru (seperti Tag baru) tanpa harus meninggalkan formulir utama postingan.
