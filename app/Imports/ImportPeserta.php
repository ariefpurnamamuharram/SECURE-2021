<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPeserta implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tanggalPembelian = array();
        array_push($tanggalPembelian, explode(' ', $row[1])[1]);
        array_push($tanggalPembelian, explode(' ', $row[1])[2]);
        array_push($tanggalPembelian, explode(' ', $row[1])[3]);
        $completeTanggalPembelian = join(" ", $tanggalPembelian);
        $formattedTanggalPembelian = date_format(date_create($completeTanggalPembelian, timezone_open('Asia/Jakarta')), 'Y-m-d');

        return new Peserta([
            'tanggal_pembelian' => $formattedTanggalPembelian,
            'nama' => str_replace('\'', '', $row[22]),
            'pekerjaan' => str_replace('\'', '', $row[21]),
            'instansi' => str_replace('\'', '', $row[19]),
            'email' => str_replace('\'', '', $row[18]),
            'nomor_telepon' => str_replace('\'', '', $row[23]),
            'jenis_tiket',
            'yang_mendaftarkan' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
