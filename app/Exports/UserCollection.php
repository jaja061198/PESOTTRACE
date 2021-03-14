<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\User as UserModel;

class UserCollection implements FromCollection
{
    // use Exportable;

    // public function query()
    // {
    //     return Invoice::query();
    // }

    public function collection()
    {
        return UserModel::all();
    }
}

