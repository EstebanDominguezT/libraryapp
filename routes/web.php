<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () { if (Auth::check()) { return redirect()->route('home'); } return redirect()->route('login'); });

Route::middleware(['avoid-back-history'])->group (function () {
    // LOGIN ROUTE
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Auth::routes();
    
    // HOME ROUTES
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::middleware(['auth'])->group (function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // AUTHOR ROUTES
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::match(['put', 'patch'], '/authors/update/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // CATEGORY ROUTES
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::match(['put', 'patch'], '/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // GENRE ROUTES
    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres/store', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');
    Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::match(['put', 'patch'], '/genres/update/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');


    // BOOK ROUTES
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::match(['put', 'patch'], '/books/update/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // BORROW ROUTES
    Route::get('/borrows', [App\Http\Controllers\BorrowController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/create', [App\Http\Controllers\BorrowController::class, 'create'])->name('borrows.create');
    Route::post('/borrows/store', [App\Http\Controllers\BorrowController::class, 'store'])->name('borrows.store');
    Route::get('/borrows/{borrow}', [App\Http\Controllers\BorrowController::class, 'show'])->name('borrows.show');
    Route::get('/borrows/{borrow}/edit', [App\Http\Controllers\BorrowController::class, 'edit'])->name('borrows.edit');
    Route::match(['put', 'patch'], '/borrows/update/{borrow}', [App\Http\Controllers\BorrowController::class, 'update'])->name('borrows.update');
    Route::delete('/borrows/{borrow}', [App\Http\Controllers\BorrowController::class, 'destroy'])->name('borrows.destroy');
});