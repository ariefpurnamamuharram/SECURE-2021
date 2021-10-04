<?php

namespace App\Http\Controllers\Export;

use App\Exports\ExportPeserta;
use App\Exports\ExportPesertaToGoogleContact;
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
            'fileExcel' => 'required',
            'filter_all_participants' => 'nullable',
            'filter_bundle_pre_event_and_main_event' => 'nullable',
            'filter_early_bird_ticket_symposium_workshop' => 'nullable',
        ]);

        Peserta::query()->truncate();

        Excel::import(new ImportPeserta(), $request->file('fileExcel'));

        $queryArg = array();

        if (!empty($request->filter_all_participants)) {
            array_push($queryArg, $request->filter_all_participants);
        }

        if (!empty($request->filter_bundle_pre_event_and_main_event)) {
            array_push($queryArg, $request->filter_bundle_pre_event_and_main_event);
        }

        if (!empty($request->filter_early_bird_ticket_symposium_workshop)) {
            array_push($queryArg, $request->filter_early_bird_ticket_symposium_workshop);
        }

        return Excel::download(new ExportPeserta($queryArg), 'daftar_peserta_secure_2021.xlsx')->deleteFileAfterSend();
    }

    public function exportToGoogleContact(Request $request)
    {
        $request->validate([
            'fileExcel' => 'required',
            'filter_all_participants' => 'nullable',
            'filter_bundle_pre_event_and_main_event' => 'nullable',
            'filter_early_bird_ticket_symposium_workshop' => 'nullable',
        ]);

        Peserta::query()->truncate();

        Excel::import(new ImportPeserta(), $request->file('fileExcel'));

        $queryArg = array();

        if (!empty($request->filter_all_participants)) {
            array_push($queryArg, $request->filter_all_participants);
        }

        if (!empty($request->filter_bundle_pre_event_and_main_event)) {
            array_push($queryArg, $request->filter_bundle_pre_event_and_main_event);
        }

        if (!empty($request->filter_early_bird_ticket_symposium_workshop)) {
            array_push($queryArg, $request->filter_early_bird_ticket_symposium_workshop);
        }

        return Excel::download(new ExportPesertaToGoogleContact($queryArg), 'daftar_peserta_secure_2021.csv')->deleteFileAfterSend();
    }
}
