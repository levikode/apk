<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitkerjaController;


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


// Route::get('/',function(){
//     return view('welcome',[
//         "title"=>"Dashboard"
//     ]);
//     })->middleware('auth');

Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
Route::resource('/laporan', LaporanController::class);

Route::resource('pegawai', PegawaiController::class)->middleware('auth');
Route::get('/pegawai/pdf', [PegawaiController::class, 'exportPdf'])->name('pegawai.pdf');

Route::resource('jabatan', JabatanController::class)->middleware('auth');
Route::resource('unitkerja', UnitkerjaController::class)->middleware('auth');

Route::resource('user', UserController::class);
Route::get('login', [LoginController::class, 'loginView'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/chart-data', [App\Http\Controllers\DashboardController::class, 'getChartData']);
