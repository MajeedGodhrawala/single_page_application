<?php

use App\Http\Controllers\AddhaarCardVerification;
use App\Http\Controllers\authContoller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserControlller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create-user',[authContoller::class,'createUser'])->name('create_user');
Route::post('loginUser',[authContoller::class,'loginUser']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    
});

//Profile
Route::prefix('profile')->as('profile.')->middleware('auth:sanctum')->group(function(){
    Route::post('/edit-profile',[ProfileController::class,'update']);
});

//User
Route::prefix('users')->as('users.')->middleware('auth:sanctum')->group(function(){
    Route::post('/data-table',[UserControlller::class,'allUserData'])->name('data_table');
    Route::post('/create-or-update/{user?}',[UserControlller::class,'createOrUpdate'])->name('create_or_update');
    Route::get('/destroy/{user}',[UserControlller::class,'destroy'])->name('destroy');
});

//Role
Route::prefix('roles')->as('roles.')->middleware('auth:sanctum')->group(function(){
    Route::post('/data-table',[RoleController::class,'allRolesData'])->name('data_table');
    Route::post('/create-or-update/{role?}',[RoleController::class,'createOrUpdate'])->name('create_or_update')->middleware('role_or_permission:add_role|edit_role');
    Route::get('/destroy/{role}',[RoleController::class,'destroy'])->name('destroy')->middleware('role_or_permission:delete_role');
    Route::post('/upload-csv-file',[RoleController::class,'import']);
    Route::get('/export-file',[RoleController::class,'export']);
});

//Permission
Route::prefix('permissions')->as('permissions.')->middleware('auth:sanctum')->group(function(){
    Route::get('/data-table',[PermissionController::class,'allPermissionsWithRoles'])->name('data_table');
    Route::post('/update-role_permissions',[PermissionController::class,'updateRolePermissions'])->name('update_role_permissions');
   
});

//AdhaarCardVerification 
Route::post('/verify',[AddhaarCardVerification::class,'verify']);


//Test SDK Data
Route::post('/send-old-data',[RoleController::class,'sendOldData']);
Route::post('/send-new-data',[RoleController::class,'sendNewData']);

Route::get('/calculate-employee-total-in-time',[RoleController::class,'CalculateEmployeesTotalInTime']);
Route::post('/calculate-new-in-time',[RoleController::class,'CalculateNewInTime']);

