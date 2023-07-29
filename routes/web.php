<?php

use App\Http\Controllers\admin\CabangController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GuruController;
use App\Http\Controllers\admin\JadwalController;
use App\Http\Controllers\admin\KelasController;
use App\Http\Controllers\admin\PembayaranController;
use App\Http\Controllers\admin\PembayaranpendaftaranController;
use App\Http\Controllers\admin\PenggunaController;
use App\Http\Controllers\admin\ProgramController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
// Rute publik yang dapat diakses oleh semua pengguna
// Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// Route::post('/login', [LoginController::class, 'index'])->name('login');
// Route::get('/login', 'auth\LoginController@login')->name('login');
Route::get('/unauthorized', function () {
    return 'Anda tidak diizinkan mengakses halaman ini.';
})->name('unauthorized');

// Route::group(['prefix' => 'admin'], function () {
//     Route::resource('/dashboard', DashboardController::class);
//     Route::resource('/users', UsersController::class);
//     Route::resource('/siswa', SiswaController::class);
//     Route::resource('/program', ProgramController::class);
//     Route::resource('/jadwal', JadwalController::class);
//     Route::resource('/cabang', CabangController::class);

//     Route::get('/get_meeting_per_weeks/{program_id}', [KelasController::class, 'get_meeting_per_weeks']);
//     Route::get('/get_class/{companyBranch}', [SiswaController::class, 'get_class']);
//     Route::resource('/kelas', KelasController::class);

//     Route::resource('/guru', GuruController::class);
//     Route::resource('/pembayaranpendaftaran', PembayaranpendaftaranController::class);
//     Route::resource('/pembayaran', PembayaranController::class);
// });

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/dashboard', DashboardController::class)->middleware('check_roles:manager,admin,director');
    Route::resource('/users', UsersController::class)->middleware('check_roles:manager,director');
    Route::resource('/siswa', SiswaController::class)->middleware('check_roles:manager,admin,director');
    Route::resource('/program', ProgramController::class)->middleware('check_roles:manager,admin,director');
    // Route::resource('/jadwal', JadwalController::class)->middleware('check_roles:manager,admin,director');
    Route::resource('/cabang', CabangController::class)->middleware('check_roles:manager,admin,director');

    Route::get('/get_meeting_per_weeks/{program_id}', [KelasController::class, 'get_meeting_per_weeks']);
    Route::get('/get_class/{companyBranch}', [SiswaController::class, 'get_class']);
    Route::resource('/kelas', KelasController::class)->middleware('check_roles:manager,admin,director');

    // Route::resource('/guru', GuruController::class);
    Route::resource('/pembayaranpendaftaran', PembayaranpendaftaranController::class)->middleware('check_roles:manager,admin,director');
    Route::resource('/pembayaran', PembayaranController::class)->middleware('check_roles:manager,admin,director');
});