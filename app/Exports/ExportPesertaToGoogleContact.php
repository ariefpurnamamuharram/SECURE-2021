<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPesertaToGoogleContact implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peserta::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama,
            $row->nomor_telepon,
        ];
    }
}
