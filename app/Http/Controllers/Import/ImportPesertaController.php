<?php

namespace App\Http\Controllers\Import;

use App\Exports\ExportPeserta;
use App\Http\Controllers\Controller;
use App\Imports\ImportPeserta;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportPesertaController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'fileCSV' => 'required|mimes:csv',
        ]);

        Peserta::query()->truncate();

        Excel::import(new ImportPeserta(), $request->file('fileCSV'));

        $peserta = Peserta::orderBy('tanggal_pembelian', 'desc')
            ->orderBy('jam_pembelian', 'desc')
            ->get();
        Peserta::query()->truncate();

        return view('welcome', [
            'peserta' => $peserta,
        ]);
    }
}
