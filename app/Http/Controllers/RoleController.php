<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function getRolesData() :JsonResponse
    {
        dd(Auth::user());
        $roles = Role::query();
        
        return response()->json(['roles' => $roles->get() ]);
    }
}
