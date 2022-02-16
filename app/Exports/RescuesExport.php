<?php

namespace App\Exports;

use App\Models\Rescue;
use Maatwebsite\Excel\Concerns\FromCollection;

class RescuesExport implements FromCollection
{
    public function collection()
    {
        $organization_id = auth()->user()->organization_id;
        return Rescue::where('organization_id', $organization_id)->get();
    }
}
