<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPeserta implements FromCollection, WithHeadings
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
            'No.',
            'Tanggal Pembelian',
            'Nama',
            'Pekerjaan',
            'Instansi',
            'Email',
            'Nomor Telepon',
            'Jenis Tiket',
            'Yang Mendaftarkan'
        ];
    }
}
