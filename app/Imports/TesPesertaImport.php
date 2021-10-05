<?php

namespace App\Imports;

use App\Models\Peserta;
use App\Models\TesPeserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TesPesertaImport implements ToModel, WithStartRow
{
    protected $arg;

    function __construct($arg)
    {
        $this->arg = $arg;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->arg == 0) {
            if (TesPeserta::where('email', $row[15])->exists()) {
                TesPeserta::where('email', $row[15])->update([
                    'pre_test' => true,
                ]);

                return null;
            } else {
                return new TesPeserta([
                    'nama' => $row[2],
                    'email' => $row[15],
                    'pre_test' => true,
                ]);
            }
        } else {
            if (TesPeserta::where('email', $row[3])->exists()) {
                TesPeserta::where('email', $row[3])->update([
                    'post_test' => true,
                ]);

                return null;
            } else {
                return new TesPeserta([
                    'nama' => $row[2],
                    'email' => $row[3],
                    'post_test' => true,
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
