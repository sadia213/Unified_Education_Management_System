<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            "id"=>$row['0'],
            "first_name"=>$row['1'],
            "last_name"=>$row['2'],
            "email"=>$row['3'],
            "student_id"=>$row['4'],
            "password"=>bcrypt($row['5']),
            "role"=>$row['6'],
            "department_id"=>$row['7'],
            "status"=>$row['8'],
        ]);
    }
}
