<?php

namespace App\Http\Controllers\Export;

use App\Exports\ExportPeserta;
use App\Http\Controllers\Controller;
use App\Imports\ImportPeserta;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPesertaController extends Controller
{
    public function exportToExcel(Request $request)
    {
        $request->validate([
            'fileCSV' => 'required',
        ]);

        Peserta::query()->truncate();

        Excel::import(new ImportPeserta(), $request->file('fileCSV'));

        return Excel::download(new ExportPeserta(), 'daftar_peserta_secure_2021.xlsx')->deleteFileAfterSend();
    }
}