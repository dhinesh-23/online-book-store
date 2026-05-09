<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'home'])->name('home');

Route::get('/books/{book}', [BookController::class, 'show'])
    ->name('books.show')
    ->where('book', '[0-9]+');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'totalBooks' => App\Models\Book::count(),
            'totalValue' => App\Models\Book::sum('price'),
            'totalAuthors' => App\Models\Book::distinct('author')->count('author'),
        ]);
    })->name('admin.dashboard');

    Route::resource('admin/books', BookController::class)
        ->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);
});

require __DIR__.'/auth.php';
