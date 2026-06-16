# Laporan Praktikum - Week 16 (RESTful API)

Nama : Rachmad Febriananda
NIM : 244107020095
Kelas : TI-2F  
Link Commit : https://github.com/rachmadnanda/Pemrograman-Web-Lanjut/commit/f7ff3eb77f17ec08b34889e8d1488fa9050f79eb

## A. Langkah Praktikum 1: Membuat Autentikasi Token pada RESTful API

Berikut adalah tahapan implementasi autentikasi menggunakan Laravel Sanctum:

### 1. Inisialisasi API Support

Menjalankan perintah untuk menginstal dukungan API dan Sanctum pada Laravel.

```bash
php artisan install:api
```

### 2. Standarisasi Response API

Membuat Trait `ApiResponse` untuk menyeragamkan format output JSON di seluruh sistem.

**File: `app/Traits/ApiResponse.php`**

```php
trait ApiResponse {
    protected function ok($data, string $message = null, int $code = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(string $message = null, int $code) {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
```

### 3. Penyesuaian Request untuk API

Membuat abstract class `ApiRequest` yang mengubah perilaku default validasi agar mengembalikan JSON saat terjadi error 422.

**File: `app/Http/Requests/ApiRequest.php`**

```php
abstract class ApiRequest extends FormRequest {
    use ApiResponse;

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->error(implode(', ', $validator->errors()->all()), 422)
        );
    }
}
```

### 4. Implementasi AuthController

Mengelola proses registrasi, login, dan logout dengan pemberian token Sanctum.

**File: `app/Http/Controllers/Api/AuthController.php`**

```php
public function login(LoginRequest $request) {
    if (!Auth::attempt($request->only('email', 'password'))) {
        return $this->error('Invalid login credentials', 401);
    }
    $user = User::where('email', $request->email)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;
    return $this->ok(['user' => $user, 'token' => $token], 'Logged in successfully');
}
```

## B. Langkah Praktikum 2: CRUD dalam RESTful API

Implementasi resource Todo yang hanya bisa diakses oleh pemiliknya.

### 1. Migration Tabel Todos

**File: `database/migrations/xxxx_create_todos_table.php`**

```php
Schema::create('todos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('task');
    $table->boolean('done')->default(false);
    $table->timestamps();
});
```

### 2. Implementasi TodoController (API Resource)

**File: `app/Http/Controllers/Api/TodoController.php`**

```php
public function store(TodoRequest $request) {
    $todo = Todo::create([
        'user_id' => $request->user()->id,
        'task' => $request->task,
    ]);
    return $this->ok($todo, 'Todo created successfully', 201);
}
```

### 3. Konfigurasi Routes API

**File: `routes/api.php`**

```php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('todos', TodoController::class);
});
```

## C. Analisis & Diskusi

1. **Apa perbedaan antara session-based authentication dan token-based authentication?**
   Session-based bersifat _stateful_ (server menyimpan data session), sedangkan token-based (seperti Sanctum) bersifat _stateless_. Server tidak menyimpan keadaan login, melainkan memverifikasi token yang dikirimkan klien pada setiap request header.

2. **Mengapa pada API kita perlu meng-override failedValidation?**
   Secara default, Laravel akan mengalihkan (_redirect_) user kembali ke halaman sebelumnya jika validasi gagal. Pada API, hal ini tidak diinginkan karena klien (seperti Postman atau aplikasi mobile) mengharapkan response JSON berupa detail error.

3. **Apa kegunaan middleware auth:sanctum?**
   Middleware ini bertugas untuk memastikan bahwa request yang masuk memiliki token yang valid. Jika token tidak ada atau tidak valid, server akan menolak akses dengan status 401 Unauthorized.

4. **Bagaimana cara mengamankan data Todo agar tidak bisa diedit oleh user lain?**
   Hal ini dilakukan melalui dua lapisan: di controller dengan memfilter data berdasarkan `user_id` yang sedang login (`$request->user()->id`), dan di `TodoRequest` melalui method `authorize()` untuk mengecek kepemilikan data sebelum proses dilanjutkan.
