<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPeserta implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = explode(';', $row[0]);

        return new Peserta([
            'tanggal_pembelian' => '2021-01-01',
            'nama' => $data[1],
            'pekerjaan' => $row[0],
            'instansi' => $row[0],
            'email' => $row[0],
            'nomor_telepon' => $row[0],
            'jenis_tiket',
            'yang_mendaftarkan' => $row[0],
        ]);
    }
}
