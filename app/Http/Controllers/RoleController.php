<?php

namespace App\Http\Controllers;

use App\Exports\RoleExport;
use App\Http\Requests\FileRequest;
use App\Http\Requests\RoleFormRequest;
use App\Imports\RolesImport;
use App\Models\AttendanceDetails;
use App\Models\TempAttendanceDetails;
use DateTime;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        return Excel::download(new RoleExport, 'roles.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);

    }



//.NET ALL-OLD DATA CALL 
    public function sendOldData(Request $request){
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        //dd(gettype($request->all()));
        // foreach($request->all() as $data){
        //     TempAttendanceDetails::updateOrInsert(
        //         $data
        //     );
        // }
            return response()->json(['status' => $data ? $data :'Failed']);
    }


//.NET NEW DATA CALL 
    public function sendNewData(Request $request){
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        foreach($request->all() as $data){
            TempAttendanceDetails::updateOrInsert(
                $data
            );
        }
            return response()->json(['status' => $data ?  :'Failed']);
    }

    public function CalculateEmployeesTotalInTime(){
        $attendence_datas = TempAttendanceDetails::select([
            DB::raw("DATE_FORMAT(VDateTime,'%Y-%m-%d') as date"),
            DB::raw("DATE_FORMAT(VDateTime,'%H:%s:%i') as time"),
            'UserId as employee_id',
            'VDateTime as verify_date_time'
        ])->orderBy('date', 'ASC')->get();
        $attendence_group_data = $attendence_datas->groupBy(['date','employee_id']);
        
        $attendence_details = [];
        foreach($attendence_group_data as $date=>$employee_data){
            foreach($employee_data as $employee_id=>$data){
                for($increment = 0; $increment < count($data); $increment++){
                    if($increment % 2 == 0){
                        $array['employee_id'] = $employee_id;
                        $array['attendance_date'] = $date;
                        $array['time_in'] = $data[$increment]->time;
                        $array['time_out'] = $data[$increment + 1]->time ?? null;
                        $time_in = new DateTime($array['time_in']);
                        $time_out = new DateTime($array['time_out']);

                        $difference = $time_out->getTimestamp() - $time_in->getTimestamp() ;
                        
                        $difference = intval(floor($difference / 60));

                        $array['time_different'] = $difference >= 0 ? $difference : null;
                        array_push($attendence_details,$array);
                    }
                }
            }
        }
        foreach($attendence_details as $attendence_detail){
            TempAttendanceDetails::updateOrInsert($attendence_detail);
        }
    }

    public function CalculateNewInTime(Request $request){
        foreach($request->all() as $data){
            $employee_detail = AttendanceDetails::where('employee_id', '=', $data['UserId'])->where('attendance_date', '=', explode(" ",$data['VDateTime'])[0])->where('time_out', '=', null)->first();

            if($employee_detail){
                $time_out = new DateTime(explode(" ",$data['VDateTime'])[1]);
                $time_in = new DateTime($employee_detail->time_in);

                $difference = $time_out->getTimestamp() - $time_in->getTimestamp();
                $difference = intval(floor($difference / 60));
                
                $employee_detail->update([
                    'employee_id' => $employee_detail->employee_id,
                    'attendance_date' => $employee_detail->attendance_date,
                    'time_in' => $employee_detail->time_in,
                    'time_out' => $time_out,
                    'time_different' => $difference,
                ]);
            } else {
                AttendanceDetails::create([
                    'employee_id' => $data['UserId'],
                    'attendance_date' => explode(" ",$data['VDateTime'])[0],
                    'time_in' => explode(" ",$data['VDateTime'])[1],
                    'time_out' => null,
                    'time_different' => null,
                ]);
            }
            //To Save New Data in Temp(SDK dump data) Attendence Table
            TempAttendanceDetails::updateOrInsert(
                $data
            );
        }
    }
}
