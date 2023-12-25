<?php

use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\BorrowApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    
    // BOOKS ROUTES
    Route::post('/books/create' , [BookApiController::class, 'store'])->name('books.store');
    Route::get('/books' , [BookApiController::class, 'index'])->name('books.index');
    Route::get('/books/{book}' , [BookApiController::class, 'show'])->name('books.show');
    Route::put('/books/update/{book}' , [BookApiController::class, 'update'])->name('books.update');
    Route::delete('/books/delete/{book}' , [BookApiController::class, 'destroy'])->name('books.destroy');

    // BORROW ROUTES
    Route::post('/borrows/create' , [BorrowApiController::class, 'store'])->name('borrows.store');
    Route::get('/borrows' , [BorrowApiController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/{borrow}' , [BorrowApiController::class, 'show'])->name('borrows.show');
    Route::put('/borrows/update/{borrow}' , [BorrowApiController::class, 'update'])->name('borrows.update');
    Route::delete('/borrows/delete/{borrow}' , [BorrowApiController::class, 'destroy'])->name('borrows.destroy');
});
