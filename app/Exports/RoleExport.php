<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Permission\Models\Role;

class RoleExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Role::select('id','name','display_name')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Display Name',
        ];
    }
}
