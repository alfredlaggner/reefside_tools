<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    public function model(array $row)
    {
        return new PhoneNumber([
            'external_id' => $row[0],
            'first_name' => $row[5],
            'last_name' => $row[6],
            'email' => $row[3],
            'phone' => $row[4],
            'number' => $row[8],
        ]);
    }
}
