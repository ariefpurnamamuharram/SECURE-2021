<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPesertaToGoogleContact implements FromCollection, WithHeadings, WithMapping
{
    protected $arg;

    function __construct($arg)
    {
        $this->arg = $arg;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peserta::orderBy('tanggal_pembelian', 'desc')
            ->orderBy('jam_pembelian', 'desc')
            ->whereIn('deskripsi_tiket', $this->arg)->get();
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
