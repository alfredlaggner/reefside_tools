<?php

namespace App\Imports;

use App\Models\PhoneNumber;
use Maatwebsite\Excel\Concerns\ToModel;

class PhoneNumberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PhoneNumber([
            //
        ]);
    }
}
