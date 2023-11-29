<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function allPermissionsWithRoles(){
        return response()->json(['roles' => Role::all(), 'role_permissions' => $this->rolePermission() ]);
    }

    public function rolePermission() 
    {
        $permissions = Permission::orderBy('category')->get();
        $roles = Role::with('permissions')->get();

        // $new = Role::find(1);

        // dd($new->hasPermissionTo('view_profile'));

        // dd($roles->toArray());

        // dd($permissions);

        $role_permission_array = collect();
        foreach($permissions as $permission){
            $role_permission_array->push([
                'id' => $permission->id,
                'name' => $permission->name,
                'display_name' => $permission->display_name,
                'category' => $permission->category,
                'guard_name' => $permission->guard_name,
                'roles' => $this->getPermissionByRoles($permission->name,$roles)
            ]);
        }

        $role_permissions = $role_permission_array->groupBy('category');
        return $role_permissions;
    }

    public function getPermissionByRoles(String $permission_name, $roles){
        $roles_array = [];
        
        foreach($roles as $role){
            array_push($roles_array,[
                'id' => $role->id,
                'name' => $role->name,
                'display_name' => $role->display_name,
                'guard_name' => $role->guard_name,
                'has_permission' => $role->hasPermissionTo($permission_name),
            ]);

        }

        return $roles_array;
    }
    public function updateRolePermissions(Request $datas){
        foreach($datas->role_permission as $role_id=>$data){
            $role = Role::find($role_id);
            $role->syncPermissions($data);
        }
        return response()->json(['updated' => 'Permission Has Been Updated']);
    }
}
