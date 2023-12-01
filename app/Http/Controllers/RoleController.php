<?php

namespace App\Http\Controllers;

use App\Exports\RoleExport;
use App\Http\Requests\FileRequest;
use App\Http\Requests\RoleFormRequest;
use App\Imports\RolesImport;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    public function allRolesData(Request $request) :JsonResponse
    {
        $roles = Role::query();
        if($request->search){
            $roles->where('name', 'like', '%' .$request->search. '%')
            ->orWhere('display_name', 'like', '%' .$request->search. '%');
        }
        $roles = $roles->select(['id', 'name', 'display_name'])->get();
        
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
    public function import(FileRequest $request){
        $import = new RolesImport;
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            Excel::import($import,$path);
        }
        return response()->json(['file' => $request->file('file')->getClientOriginalName(), 'summery' => $import->summery]);
    }
    public function export(){
        // return ['file' => Excel::download(new RoleExport, 'roles.csv', \Maatwebsite\Excel\Excel::CSV, [
        //         'Content-Type' => 'text/csv',
        //     ]), 'file_name' => 'Roles'.date("Y-m-d").'.csv'];
            
        return Excel::download(new RoleExport, 'roles.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
