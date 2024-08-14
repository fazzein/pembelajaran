<?php

use App\Http\Controllers\{
    UserController,
    MainController,
    SiswaController,
    DashboardController,
    KelasController
};
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController::class,'index'])
->middleware(['auth', 'verified'])
->name('dashboard');
Route::post('/data', [DashboardController::class,'getData'])
->middleware(['auth', 'verified'])
->name('getData');
Route::get('/kegiatan/getPersentase', [DashboardController::class, 'getPersentase'])
->name('kegiatan.getPersentase');

Route::post('/data-dashboard', [DashboardController::class,'getDataLeader'])
->middleware(['auth', 'verified'])
->name('getData');


Route::middleware(['role:admin'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('/', [userController::class, 'index'])->name('user.index');
        Route::match(['get','put'], '/create', [UserController::class, 'create'])->name('user.create');
        Route::match(['get', 'patch'],'/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
        Route::match(['get'], '/{id}/view', [UserController::class, 'view'])->name('user.view');
    });
   
    Route::prefix('siswa')->group(function (){
        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
        Route::match(['get', 'put'], '/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::match(['get', 'patch'], '/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::match(['get'], '/{id}/view', [SiswaController::class, 'view'])->name('siswa.view');
        Route::delete('/{id}/delete', [SiswaController::class, 'destroy'])->name('siswa.delete');
    });

    Route::prefix('kelas')->controller(KelasController::class)->group(function (){
        Route::get('/', 'index')->name('kelas.index');
        Route::match(['get', 'put'], '/create', 'create')->name('kelas.create');
        Route::match(['get', 'patch'], '/{id}/edit', 'edit')->name('kelas.edit');
        Route::get('/{id}/view', 'view')->name('kelas.view');
        Route::delete('/{id}/delete', 'destroy')->name('kelas.delete');
    });
    
    
});



Route::post('generate-json/select2', [MainController::class, 'select2Response'])->name('generate.json.select2');

require __DIR__.'/auth.php';
