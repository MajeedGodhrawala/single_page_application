<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RolesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $summery = [
        'total_records'=> 0,
         'create' => 0,
         'update' => 0,
      ];
    public function collection(Collection $rows)
    {
        $customMessages = [
            'required' => 'The field is required.',
            'unique' => 'The field is already exists.' ,
        ];

        $validator = Validator::make($rows->toArray(), [
            '*.name' => "required",
       ],$customMessages);
       $validator->validate();

       foreach ($rows as $key=>$row) 
        {  
            $check_role = Role::where('id', '=', $row['id'])
                ->orWhere('name', '=', $row['name'])
                ->first();
            
            $role = $check_role ?? new Role();
            $role->fill([
                        'name' => $row['name'],
                        'display_name' => $row['display_name'],
                        'guard_name' => $row['guard_name'],
                    ])->save();
                    
            $this->summery['total_records'] = count($rows);
            $this->summery[$check_role ? 'update' : 'create']++;
        }
    }
}
