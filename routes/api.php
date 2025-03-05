<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::post('/loginuser', [AuthController::class, 'loginUser']);
Route::post('/loginadmin', [AuthController::class, 'loginAdmin']);


// routes/api.php

Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout']);


// routes/api.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

// Daftar buku


// Detail buku


// Route yang membutuhkan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    // Peminjaman buku
    Route::post('/books/{bookId}/borrow', [BorrowingController::class, 'borrow']);
    // Pengembalian buku
    Route::post('/books/{bookId}/return', [BorrowingController::class, 'returnBook']);

    // Admin: Menambah buku
    Route::post('/books', [BookController::class, 'store']);
    // Admin: Mengupdate buku
    Route::put('/books/{id}', [BookController::class, 'update']);
    // Admin: Menghapus buku
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});








