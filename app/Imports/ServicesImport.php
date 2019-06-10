<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServicesImport implements OnEachRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $check = Service::where('code', $row['code'])->count();

        if ($check == 0) {
            Service::create([
                'code'     => $row['code'],
                'name'    => $row['name'],
                'default_cost' => $row['defaultcost'],
            ]);
        }
    }
}
