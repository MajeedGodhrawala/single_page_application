<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(UserFormRequest $request){
        $data = $request->requestedField();
        if ($request->hasFile('profile_img')) {
            $imagePath = $this->getImagePath($request->profile_img);
            $data['profile_img'] = $imagePath;
        } else {
            $data['profile_img'] = $request->profile_img;
        }
    
        $user = User::findOrFail($request->id);
    
        $user->update($data);
        $user->save();
    
        return response()->json(['updated' => 'Your Profile Is Edited !!' , 'updated_data' => User::findOrFail($request->id) ]);
    }
    
    public function getImagePath($profile_img){
        $img_name = 'img_'.time().'.'.$profile_img->getClientOriginalExtension();
        $profile_img->move(public_path('upload_img/'), $img_name);
        $imagePath = 'upload_img/'.$img_name;
    
        return $imagePath;
    }
}
