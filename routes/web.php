<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('myFiles');
});

// Route::controller(\App\Http\Controllers\FileController::class)
//     ->middleware(['auth'])
//     ->group(function () {
//         // Route::post('/file', 'store')->name('file.store');
//         Route::get('/my-files/{folder?}', 'myFiles')
//             ->where('folder', '(.*)')
//             ->name('myFiles');
//         Route::post('/folder/create', 'createFolder')->name('folder.create');
//         Route::post('/file', 'destroy')->name('file.delete');
//     });

Route::middleware(['auth'])->group(function () {
    Route::get('/file/download-shared-with-me', [FileController::class, 'downloadSharedWithMe'])->name('file.downloadSharedWithMe');
    Route::get('/file/download-shared-by-me', [FileController::class, 'downloadSharedByMe'])->name('file.downloadSharedByMe');
    Route::post('/add-to-favourites', [FileController::class, 'addToFavourites'])->name('file.addToFavourites');
    Route::post('/restore', [FileController::class, 'restore'])->name('file.restore');
    Route::post('/file', [FileController::class, 'store'])->name('file.store');
    Route::post('/file/share', [FileController::class, 'share'])->name('file.share');
    Route::post('/file/rename', [FileController::class, 'rename'])->name('file.rename');
    Route::get('/shared-with-me', [FileController::class, 'sharedWithMe'])->name('file.sharedWithMe');
    Route::get('/shared-by-me', [FileController::class, 'sharedByMe'])->name('file.sharedByMe');
    Route::get('/file/download', [FileController::class, 'download'])->name('file.download');
    Route::get('/my-files/{folder?}', [FileController::class, 'myFiles'])
        ->where('folder', '(.*)')
        ->name('myFiles');
    Route::get('/trash', [FileController::class, 'trash'])->name('trash');
    Route::delete('/delete-forever', [FileController::class, 'deleteForever'])->name('file.deleteForever');

    Route::post('/folder/create', [FileController::class, 'createFolder'])->name('folder.create');
    Route::delete('/file', [FileController::class, 'destroy'])->name('file.delete');

});

Route::get('/dashboard', function () {
    return redirect()->route('myFiles');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
