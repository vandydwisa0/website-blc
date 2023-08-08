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
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
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
Auth::routes();

Route::prefix('admin')->group(function () {
    Route::middleware(['firebase_auth'])->group(function () {
        Route::resource('/dashboard', DashboardController::class)->middleware('verify_user:admin,manager,director');
        Route::resource('/users', UsersController::class)->middleware('verify_user:manager,director');
        // Route::post('/update-email-verification/{id}', 'StaffController@updateEmailVerification')->name('updateEmailVerification');
        // Route::get('/update-email-verification/{id}', UsersController::class, 'updateEmailVerification');
        // Route::post('/update/{id}', UsersController::class, 'updateEmailVerification');
        Route::resource('/siswa', SiswaController::class)->middleware('verify_user:manager,admin,director');
        // Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index')->middleware('verify_user:manager,admin,director');
        Route::resource('/program', ProgramController::class)->middleware('verify_user:manager,admin,director');
        // Route::resource('/jadwal', JadwalController::class)->middleware('verify_user:manager,admin,director');
        Route::resource('/cabang', CabangController::class)->middleware('verify_user:manager,admin,director');

        Route::get('/get_meeting_per_weeks/{program_id}', [KelasController::class, 'get_meeting_per_weeks']);
        Route::get('/get_class/{companyBranch}', [SiswaController::class, 'get_class']);
        Route::resource('/kelas', KelasController::class)->middleware('verify_user:manager,admin,director');

        // Route::resource('/guru', GuruController::class);
        // Route::get('/events/filter', 'PembayaranpendaftaranController@filterEvents')->name('events.filter');
        Route::get('/pembayaranpendaftaran/filter', [PembayaranpendaftaranController::class, 'filter'])->name('pembayaranpendaftaran.filter');
        // Route::get('/post_start_end_date', [PembayaranpendaftaranController::class, 'postStartEndDate']);
        Route::get('/invoicedetails/{noPayment}', [PembayaranpendaftaranController::class, 'invoicedetails'])->middleware('verify_user:manager,admin,director');
        Route::get('/print', [PembayaranpendaftaranController::class, 'print'])->middleware('verify_user:manager,admin,director');
        // Route::get('/filter_data', [PembayaranpendaftaranController::class, 'filterData']);
        Route::resource('/pembayaranpendaftaran', PembayaranpendaftaranController::class)->middleware('verify_user:manager,admin,director');
        // Rute untuk mengambil opsi-opsi nisBlc
        Route::get('/get_nis_blc_options', [PembayaranController::class, 'getNisBlcOptions']);

        // Rute untuk mengambil data siswa berdasarkan nisBlc
        Route::get('/get_student_by_nis_blc/{nisBlc}', [PembayaranController::class, 'getStudentByNisBlc']);
        Route::get('/invoicedetailspembayaran/{noPayment}', [PembayaranController::class, 'invoicedetailspembayaran'])->middleware('verify_user:manager,admin,director');
        Route::get('/printpembayaran', [PembayaranController::class, 'printpembayaran'])->middleware('verify_user:manager,admin,director');
        Route::resource('/pembayaran', PembayaranController::class)->middleware('verify_user:manager,admin,director');
    });
});

// Route::group(['prefix' => 'admin', 'middleware' => ['firebase_auth']], function () {
//     Route::resource('/dashboard', DashboardController::class)->middleware('verify_user:manager,director');
//     Route::resource('/users', UsersController::class)->middleware('verify_user:manager,director');
//     Route::resource('/siswa', SiswaController::class)->middleware('verify_user:manager,admin,director');
//     Route::resource('/program', ProgramController::class)->middleware('verify_user:manager,admin,director');
//     // Route::resource('/jadwal', JadwalController::class)->middleware('verify_user:manager,admin,director');
//     Route::resource('/cabang', CabangController::class)->middleware('verify_user:manager,admin,director');

//     Route::get('/get_meeting_per_weeks/{program_id}', [KelasController::class, 'get_meeting_per_weeks']);
//     Route::get('/get_class/{companyBranch}', [SiswaController::class, 'get_class']);
//     Route::resource('/kelas', KelasController::class)->middleware('verify_user:manager,admin,director');

//     // Route::resource('/guru', GuruController::class);
//     Route::resource('/pembayaranpendaftaran', PembayaranpendaftaranController::class)->middleware('verify_user:manager,admin,director');
//     Route::resource('/pembayaran', PembayaranController::class)->middleware('verify_user:manager,admin,director');
// });



Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
