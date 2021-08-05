<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
USE Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ImportUsers implements ToModel,WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email'=> $row['email'],
            'password'=> \Hash::make($row['password']),
            'age' => $row['age']

        ]);
    }
}
