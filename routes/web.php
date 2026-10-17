<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// Arahkan halaman utama langsung ke tabel CRUD
Route::get('/', [ItemController::class, 'index']);

// Jalur otomatis untuk Create, Read, Update, Delete
Route::resource('items', ItemController::class);

// Jalur Bonus API Controller (Mengembalikan JSON)
Route::get('/api/items', [ItemController::class, 'apiIndex']);