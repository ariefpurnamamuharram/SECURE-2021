<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPeserta implements FromCollection, WithHeadings, WithMapping
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
            'Tanggal Pembelian',
            'Jam Pembelian',
            'Nama',
            'Pekerjaan',
            'Instansi',
            'Email',
            'Nomor Telepon',
            'Deskripsi Tiket',
            'Yang Mendaftarkan'
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal_pembelian,
            $row->jam_pembelian,
            $row->nama,
            $row->pekerjaan,
            $row->instansi,
            $row->email,
            $row->nomor_telepon,
            $row->deskripsi_tiket,
            $row->yang_mendaftarkan,
        ];
    }
}
