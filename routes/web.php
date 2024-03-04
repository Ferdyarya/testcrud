<?php

use App\Models\Brgmasuk;
use App\Models\Masterbatu;
use App\Models\Laporanharian;
use App\Models\Masterpegawai;
use App\Models\Pembelianbatu;
use App\Models\Pendafoutlite;
use App\Models\Mastercustomer;
use App\Models\Mastersupplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrgmasukController;
use App\Http\Controllers\BatumasukController;
use App\Http\Controllers\BrgkeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterbatuController;
use App\Http\Controllers\LaporanharianController;
use App\Http\Controllers\MasterpegawaiController;
use App\Http\Controllers\PembelianbatuController;
use App\Http\Controllers\PendafoutliteController;
use App\Http\Controllers\MastercustomerController;
use App\Http\Controllers\MastersupplierController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    $jumlahsales = Masterpegawai::count();
    return view('dashboard', compact('jumlahsales'));
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Master Data New
    Route::resource('mastersupplier', MastersupplierController::class);
    Route::resource('masterbatu', MasterbatuController::class);
    Route::resource('masterpegawai', MasterpegawaiController::class);
    Route::resource('mastercustomer', MastercustomerController::class);

// Data Tables
    Route::resource('pembelianbatu', PembelianbatuController::class);
    Route::resource('batumasuk', BatumasukController::class);
    Route::resource('laporanharian', LaporanharianController::class);


// Data Tables Report Report
    Route::get('pembelianbatupdf', [PembelianbatuController::class, 'pembelianbatupdf'])->name('pembelianbatupdf');
    Route::get('batumasukpdf', [BatumasukController::class, 'batumasukpdf'])->name('batumasukpdf');
    Route::get('laporanharianpdf', [LaporanharianController::class, 'laporanharianpdf'])->name('laporanharianpdf');
// Route::get('pernamapdf', [LaporanharianController::class, 'pernamapdf'])->name('pernamapdf');


// Validasi di cek!! kebawah
    Route::patch('pegawai/{id}/validasi', [PembelianbatuController::class, 'validasi'])->name('validasipegawai');

// Recap Laporan Tampilan
    Route::get('laporan/pernama', [PembelianbatuController::class, 'pernama'])->name('pernama');
    Route::get('laporan/laporanbatu', [PembelianbatuController::class, 'cetakpegawaipertanggal'])->name('laporanbatu');
    Route::get('laporan/laporanbatumasuk', [BatumasukController::class, 'cetakbatupertanggal'])->name('laporanbatumasuk');
    Route::get('laporan/laporanharianjual', [LaporanharianController::class, 'cetakharianpertanggal'])->name('laporanharianjual');

// Filtering
    Route::get('laporanbatu', [PembelianbatuController::class, 'filterdate'])->name('laporanbatu');
    Route::get('laporanbatumasuk', [BatumasukController::class, 'filterdatebatu'])->name('laporanbatumasuk');
    Route::get('laporanharianjual', [LaporanharianController::class, 'filterdateharian'])->name('laporanharianjual');



// Filter Laporan
    Route::get('pernamapdf/filter={filter}', [PembelianbatuController::class, 'pernama_pdf'])->name('pernamapdf');
    Route::get('laporanbatupdf/filter={filter}', [PembelianbatuController::class, 'laporanbatupdf'])->name('laporanbatupdf');
    Route::get('laporanbatumasukpdf/filter={filter}', [BatumasukController::class, 'laporanbatumasukpdf'])->name('laporanbatumasukpdf');
Route::get('laporanharianjualpdf/filter={filter}', [LaporanharianController::class, 'laporanharianjualpdf'])->name('laporanharianjualpdf');


});



// Login Register
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








