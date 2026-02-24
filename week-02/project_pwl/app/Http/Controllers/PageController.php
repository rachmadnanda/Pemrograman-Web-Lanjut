<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return 'Nama: Rachmad Febriananda, NIM: 244107020095'; // Sesuaikan NIM-mu
    }

    public function articles($id) {
        return 'Halaman Artikel dengan Id ' . $id;
    }
}
