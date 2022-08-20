<?php

namespace App\Exports;

use App\Models\EmailContact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmailContactExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmailContact::where('owner_id', Auth::user()->id)->get();
    }
}
