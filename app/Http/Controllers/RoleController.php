<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function allRolesData(Request $request) :JsonResponse
    {
        $roles = Role::query();
        if($request->search){
            $roles->where('name', 'like', '%' .$request->search. '%')
            ->orWhere('display_name', 'like', '%' .$request->search. '%');
        }
        $roles = $roles->select(['id', 'name', 'display_name', 'guard_name'])->get();
        
        return response()->json(['roles' => $roles ]);
    }

    public function createOrUpdate(RoleFormRequest $request, Role $role) :JsonResponse
    {
        $role->fill($request->requestedField())->save();
        return response()->json([
            'success' => $request->display_name.' Is '.($request->id ? 'Updated' : 'Added')]);
    }
    public function destroy(Role $role) :JsonResponse
    {
        // $role->delete();
        DB::table("roles")->where('id', $role->id)->delete();
        return response()->json(['delete' => 'Record '.$role->display_name.' Is Deleted.']);
    }
}
