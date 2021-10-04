<?php

namespace App\Http\Controllers\Import;

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
            'fileExcel' => 'required|mimes:xls,xlsx',
            'filter_all_participants' => 'nullable',
            'filter_bundle_pre_event_and_main_event' => 'nullable',
            'filter_early_bird_ticket_symposium_workshop' => 'nullable',
        ]);

        Peserta::query()->truncate();

        Excel::import(new ImportPeserta(), $request->file('fileExcel'));

        $query = Peserta::orderBy('tanggal_pembelian', 'desc')
            ->orderBy('jam_pembelian', 'desc');

        $queryArg = array();

        if(!empty($request->filter_all_participants)) {
            array_push($queryArg, $request->filter_all_participants);
        }

        if(!empty($request->filter_bundle_pre_event_and_main_event)) {
            array_push($queryArg, $request->filter_bundle_pre_event_and_main_event);
        }

        if(!empty($request->filter_early_bird_ticket_symposium_workshop)) {
            array_push($queryArg, $request->filter_early_bird_ticket_symposium_workshop);
        }

        $peserta = $query->whereIn('deskripsi_tiket', $queryArg)->get();

        Peserta::query()->truncate();

        return view('welcome', [
            'peserta' => $peserta,
            'filter_all_participants' => $request->filter_all_participants,
            'filter_bundle_pre_event_and_main_event' => $request->filter_bundle_pre_event_and_main_event,
            'filter_early_bird_ticket_symposium_workshop' => $request->filter_early_bird_ticket_symposium_workshop,
        ]);
    }
}
