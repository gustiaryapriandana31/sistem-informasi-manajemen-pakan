<?php

use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\FeedingController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/budidaya/list', [BudidayaController::class, 'index_for_user'])->name('budidaya.index.guest');
Route::get('/', function () {
    return view('analytics');
});
Route::get('/budidaya', [BudidayaController::class, 'index'])->name('budidaya.index');
Route::get('/budidaya/{budidaya:id_budidaya}', [BudidayaController::class, 'show'])->name('budidaya.show');

Route::get('/dashboard', function () {
    return view('dashboard-adm');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/budidaya', BudidayaController::class)->except('index', 'show');
    
    Route::resource('/feeding', FeedingController::class)->except('create', 'store');
    Route::get('/feeding/create/{budidaya:id_budidaya}', [FeedingController::class, 'create'])->name('feeding.create');
    Route::post('/feeding/store/{budidaya:id_budidaya}', [FeedingController::class, 'store'])->name('feeding.store');
    
    Route::resource('/panen', PanenController::class)->except('create', 'store');
    Route::get('/panen/create/{budidaya:id_budidaya}', [PanenController::class, 'create'])->name('panen.create');
    Route::post('/panen/store/{budidaya:id_budidaya}', [PanenController::class, 'store'])->name('panen.store');

});

require __DIR__.'/auth.php';