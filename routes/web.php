<?php

use App\Http\Controllers\Export\ExportPesertaController;
use App\Http\Controllers\Import\ImportPesertaController;
use App\Models\Peserta;
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
    Peserta::query()->truncate();

    return view('welcome');
});

Route::post('impor-peserta', [ImportPesertaController::class, 'import'])->name('import.peserta');

Route::post('export-peserta-to-excel', [ExportPesertaController::class, 'exportToExcel'])->name('export.peserta.to.excel');

Route::post('export-peserta-to-google-contact', [ExportPesertaController::class, 'exportToGoogleContact'])->name('export.peserta.to.google.contact');
