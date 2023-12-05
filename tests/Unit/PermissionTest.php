<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission;
use Tests\TestCase;

// use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function setUp() :void
    {
        parent::setUp();

        $this->actingAs(User::first());

    }

    public function test_permissions_table()
    {
        $response = $this->get(route('permissions.data_table'));
        $response->assertStatus(200);
    }

    public function test_update_permission()
    {
        $data = [ 
            "role_permission" => [
                1 => [
                    "view_profile",
                    "edit_profile",
                    "edit_role",
                    "add_user",
                    "edit_user",
                    "delete_user",
                ],
                2 => [
                    "delete_role",
                    "edit_role",
                    "view_user",
                    "add_user",
                ]
            ]  
        ];

        $response = $this->post(route('permissions.update_role_permissions'),$data);

        $response->assertStatus(200);


        foreach($data['role_permission'] as $role_id => $permission_names){
            foreach($permission_names as $permission_name){
                $permission = DB::table("permissions")
                ->where('name', '=', $permission_name)
                ->first();
                $this->assertDatabaseHas('role_has_permissions',[
                    'permission_id' => $permission->id,
                    'role_id' => $role_id
                ]);
              
            }
         }

        // foreach($data as $key=>$value){
        //     foreach($value as $key=>$value){
        //         foreach($value as $key=>$value){
        //            $permission = DB::table("permissions")->where('name', '=', $value)->first();
        //            $this->assertDatabaseHas('role_has_permissions',[
        //             'permission_id' => $permission
        //             ->id,
        //         ]);
        //         }
        //     }
        // }

        // $this->assertDatabaseHas('role_has_permissions',[
        //     'permission_id' => 2,
        // ]);

    }
}
