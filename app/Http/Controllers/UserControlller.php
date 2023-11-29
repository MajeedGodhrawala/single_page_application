<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserControlller extends Controller
{
    public function allUserData(Request $request) :JsonResponse
    {
        $users = User::query();
        if($request->search){
            $users->where('first_name', 'like', '%' .$request->search. '%')
            ->orWhere('last_name', 'like', '%' .$request->search. '%')
            ->orWhere('email', 'like', '%' .$request->search. '%')
            ->orWhere('phone_number', 'like', '%' .$request->search. '%')
            ->orWhere('country', 'like', '%' .$request->search. '%')
            ->orWhere('state', 'like', '%' .$request->search. '%');
        }
        $users = $users->select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'country', 'state', 'accept_privacy', 'isactive', 'profile_img', ])->get();
        
        return response()->json(['users' => $users ]);
    }

    public function createOrUpdate(UserFormRequest $request, User $user) :JsonResponse
    {
        $user->fill($request->requestedField())->save();
        return response()->json([
            'success' => $request->first_name.' '.$request->last_name.' Is '.($request->id ? 'Updated' : 'Added')]);
    }
    public function destroy(User $user) :JsonResponse
    {
        // dd($role->id);
        // $role = Role::find($role->id);

        $user->delete();
        return response()->json(['delete' => 'Record '.$user->first_name.' '.$user->last_name.' Is Deleted.']);
    }
}
