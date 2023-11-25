<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function allRolesData(Request $request) :JsonResponse
    {
        $roles = Role::query();
        if($request->search){
            $roles->where('name', 'like', '%' .$request->search. '%')
            ->orWhere('display_name', 'like', '%' .$request->search. '%');
        }
        return response()->json(['roles' => $roles->get() ]);
    }
}
