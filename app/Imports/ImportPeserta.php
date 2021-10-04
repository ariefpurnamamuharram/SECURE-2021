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
        if ($row[11] == 'Telah Diverifikasi') {
            $formattedTanggalPembelian = date_format(date_create($row[1], timezone_open('Asia/Jakarta')), 'Y-m-d');
            $formattedJamPembelian = date_format(date_create($row[1], timezone_open('Asia/Jakarta')), 'H:i:s');

            // Index pendaftar
            $iNama = 6;
            $iPekerjaan = 5;
            $iInstansi = 3;
            $iEmail = 2;
            $iNomorTelepon = 7;
            $iDeskripsiTiket = 1;

            // Get pendaftar tambahan
            $tmpPendaftarTambahan = array();
            for ($i = 25; $i <= 112; $i++) {
                if (!empty($row[$i])) {
                    array_push($tmpPendaftarTambahan, $row[$i]);
                }
            }
            if (sizeof($tmpPendaftarTambahan) != 0) {
                for ($i = 1; $i <= (sizeof($tmpPendaftarTambahan) / 8); $i++) {
                    if (sizeof($tmpPendaftarTambahan) / 8 == 1) {
                        if (strlen(str_replace('\'', '', $tmpPendaftarTambahan[($iNomorTelepon - 1)])) <= 15) {
                            $nomorTelepon = str_replace('\'', '', $tmpPendaftarTambahan[($iNomorTelepon - 1)]);
                            $formattedNomorTelepon = substr_replace($nomorTelepon, '+628', 0, 2);
                        } else {
                            $formattedNomorTelepon = '+62';
                        }

                        Peserta::create([
                            'tanggal_pembelian' => $formattedTanggalPembelian,
                            'jam_pembelian' => $formattedJamPembelian,
                            'nama' => str_replace('\'', '', $tmpPendaftarTambahan[($iNama - 1)]),
                            'pekerjaan' => str_replace('\'', '', $tmpPendaftarTambahan[($iPekerjaan - 1)]),
                            'instansi' => str_replace('\'', '', $tmpPendaftarTambahan[($iInstansi - 1)]),
                            'email' => str_replace('\'', '', $tmpPendaftarTambahan[($iEmail - 1)]),
                            'nomor_telepon' => $formattedNomorTelepon,
                            'jenis_tiket',
                            'deskripsi_tiket' => str_replace("\"", "", str_replace('\'', '', str_replace('\\', '', $tmpPendaftarTambahan[($iDeskripsiTiket - 1)]))),
                            'yang_mendaftarkan' => $row[2],
                        ]);
                    } else {
                        if (strlen(str_replace('\'', '', $tmpPendaftarTambahan[($iNomorTelepon - 1) + (8 * ($i - 1))])) <= 15) {
                            $nomorTelepon = str_replace('\'', '', $tmpPendaftarTambahan[($iNomorTelepon - 1) + (8 * ($i - 1))]);
                            $formattedNomorTelepon = substr_replace($nomorTelepon, '+628', 0, 2);
                        } else {
                            $formattedNomorTelepon = '+62';
                        }

                        Peserta::create([
                            'tanggal_pembelian' => $formattedTanggalPembelian,
                            'jam_pembelian' => $formattedJamPembelian,
                            'nama' => str_replace('\'', '', $tmpPendaftarTambahan[($iNama - 1) + (8 * ($i - 1))]),
                            'pekerjaan' => str_replace('\'', '', $tmpPendaftarTambahan[($iPekerjaan - 1) + (8 * ($i - 1))]),
                            'instansi' => str_replace('\'', '', $tmpPendaftarTambahan[($iInstansi - 1) + (8 * ($i - 1))]),
                            'email' => str_replace('\'', '', $tmpPendaftarTambahan[($iEmail - 1) + (8 * ($i - 1))]),
                            'nomor_telepon' => $formattedNomorTelepon,
                            'jenis_tiket',
                            'deskripsi_tiket' => str_replace("\"", "", str_replace('\'', '', str_replace('\\', '', $tmpPendaftarTambahan[($iDeskripsiTiket - 1) + (8 * ($i - 1))]))),
                            'yang_mendaftarkan' => $row[2],
                        ]);
                    }
                }
            }

            if (strlen(str_replace('\'', '', $row[16 + $iNomorTelepon])) <= 15) {
                $nomorTelepon = str_replace('\'', '', $row[16 + $iNomorTelepon]);
                $formattedNomorTelepon = substr_replace($nomorTelepon, '+628', 0, 2);
            } else {
                $formattedNomorTelepon = '+62';
            }

            return new Peserta([
                'tanggal_pembelian' => $formattedTanggalPembelian,
                'jam_pembelian' => $formattedJamPembelian,
                'nama' => str_replace('\'', '', $row[16 + $iNama]),
                'pekerjaan' => str_replace('\'', '', $row[16 + $iPekerjaan]),
                'instansi' => str_replace('\'', '', $row[16 + $iInstansi]),
                'email' => str_replace('\'', '', $row[16 + $iEmail]),
                'nomor_telepon' => $formattedNomorTelepon,
                'jenis_tiket',
                'deskripsi_tiket' => str_replace("\"", "", str_replace('\'', '', str_replace('\\', '', $row[16 + $iDeskripsiTiket]))),
                'yang_mendaftarkan' => $row[2],
            ]);
        } else {
            return null;
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
