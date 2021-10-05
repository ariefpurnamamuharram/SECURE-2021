<?php

namespace App\Http\Controllers\TesPeserta;

use App\Http\Controllers\Controller;
use App\Imports\TesPesertaImport;
use App\Models\TesPeserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TesPesertaController extends Controller
{
    public function imporHasilTes(Request $request)
    {
        $request->validate([
            'fileExcelPreTest' => 'required|mimes:xls,xlsx',
            'fileExcelPostTest' => 'required|mimes:xls,xlsx',
        ]);

        TesPeserta::query()->truncate();

        Excel::import(new TesPesertaImport(0), $request->file('fileExcelPreTest'));

        Excel::import(new TesPesertaImport(1), $request->file('fileExcelPostTest'));

        $peserta = TesPeserta::orderBy('nama', 'ASC')->get();

        TesPeserta::query()->truncate();

        return view('pre_and_post_test_scanner', [
            'peserta' => $peserta,
        ]);
    }
}
