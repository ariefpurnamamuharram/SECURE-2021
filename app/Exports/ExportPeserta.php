<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPeserta implements FromCollection, WithHeadings, WithMapping
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
