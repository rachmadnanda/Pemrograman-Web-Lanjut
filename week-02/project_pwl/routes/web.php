<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function () {
use App\Http\Controllers\WelcomeController;
Route::get('/hello', [WelcomeController::class, 'hello']);

use App\Http\Controllers\PageController;
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/articles/{id}', [PageController::class, 'articles']);

Route::get('/world', function () {
    return 'World';
});

Route::get('/user/{name}', function ($name) {
return 'Nama saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}', function
($postId, $commentId) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/user/{name?}', function ($name='John') {
return 'Nama saya '.$name;
});

//routing dengan controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;

Route::get('/', HomeController::class);
Route::get('/about', AboutController::class);
Route::get('/articles/{id}', ArticleController::class);

use App\Http\Controllers\PhotoController;
Route::resource('photos', PhotoController::class);

//Route::get('/greeting', function () {
//    return view('blog.hello', ['name' => 'Rachmad Febriananda']);
//});

Route::get('/greeting', [WelcomeController::class, 'greeting']);