<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Closure;
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
        $custom_messages = [
            'required' => ':input|The field is required.',
            'string' => ':input|The field format is to be string.'
        ];

        Validator::make(
            $rows->toArray(),
            [
                '*.id' => function (string $attribute, mixed $value, Closure $fail){
                    if($value){
                        if(!Role::where('id', '=', $value)->exists()){
                            $fail(":input|The field format is invalid.");
                        }
                    }
                },
                '*.name' => "required|string|min:2",
                '*.display_name' => "required|string|min:2",
        ],$custom_messages)
        ->validate();
       

       $update_array = [];

       foreach ($rows as $row) 
        {  
            $role = Role::where('id', '=', $row['id'])
                ->orWhere('name', '=', $row['name'])
                ->first() ?? new Role();

            if(!in_array($role->id || $role->name,$update_array)){
                array_push($update_array,$role->id);
            }

            $role->fill([
                'name' => $row['name'],
                'display_name' => $row['display_name'],
                'guard_name' => 'api',
            ])->save();
                    
            $this->summery['total_records'] = count($rows);

            if($row['id'] || $row['name'] == null){
                $this->summery['create']++;
            }
            
            $this->summery['update'] = count($update_array);
        }
    }
}
