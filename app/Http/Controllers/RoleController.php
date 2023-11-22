<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRolesData(Request $request) :JsonResponse
    {
        $role = Role::query();
        $total_records = count($role->get());
        
        return response()->json(['success' => $total_records ]);
    }
}
