<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\UnitkerjaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;


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
Route::resource('pegawai',PegawaiController::class);
Route::resource('golongan', GolonganController::class)->middleware('auth');
Route::resource('keluarga', KeluargaController::class)->middleware('auth');
Route::resource('agama', AgamaController::class)->middleware('auth');
Route::resource('unitkerja', UnitkerjaController::class)->middleware('auth');

Route::resource('user',UserController::class)->except('destroy','create','show','update','edit');
Route::get('login',[LoginController::class,'loginView'])->name('login');
Route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout'])->name('auth.logout')->middleware('auth');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPDF'])->name('laporan.export.pdf');

Route::get('/', [DashboardController::class, 'index']);

Route::get('/chart-data', [App\Http\Controllers\DashboardController::class, 'getChartData']);
