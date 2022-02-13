<?php

namespace App\Exports;

use App\Models\New_Tutorial;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsTutorialExport implements FromCollection
{

    public function collection()
    {
        return New_Tutorial::all();
    }
}
