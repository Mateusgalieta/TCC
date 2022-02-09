<?php

namespace App\Exports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnimalsExport implements FromCollection
{
    public function collection()
    {
        $organization_id = auth()->user()->organization_id;
        return Animal::where('organization_id', $organization_id)->get();
    }
}
