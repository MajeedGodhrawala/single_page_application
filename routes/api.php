<?php

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

Route::post('createUser',[authContoller::class,'createUser']);
Route::post('loginUser',[authContoller::class,'loginUser']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    
});

//Profile
Route::prefix('profile')->as('profile.')->middleware('auth:sanctum')->group(function(){
    Route::post('/edit-profile',[ProfileController::class,'update']);
});

//User
Route::prefix('users')->as('users.')->middleware('auth:sanctum')->group(function(){
    Route::post('/data-table',[UserControlller::class,'allUserData']);
    Route::post('/create-or-update/{user?}',[UserControlller::class,'createOrUpdate']);
    Route::get('/destroy/{user}',[UserControlller::class,'destroy']);
});

//Role
Route::prefix('roles')->as('roles.')->middleware('auth:sanctum')->group(function(){
    Route::post('/data-table',[RoleController::class,'allRolesData']);
    Route::post('/create-or-update/{role?}',[RoleController::class,'createOrUpdate'])->middleware('role_or_permission:add_role|edit_role');
    Route::get('/destroy/{role}',[RoleController::class,'destroy'])->middleware('role_or_permission:delete_role');
});

//Permission
Route::prefix('permissions')->as('permissions.')->middleware('auth:sanctum')->group(function(){
    Route::get('/data-table',[PermissionController::class,'allPermissionsWithRoles']);
    Route::post('/update-role_permissions',[PermissionController::class,'updateRolePermissions']);
   
});