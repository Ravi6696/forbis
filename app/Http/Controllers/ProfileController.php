<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'email|unique:users,email,' . $request->user_id . ',id',
                ]
            );
            if ($validator->fails()) {
                $result['key'] = 0;
                $result['message'] = implode(',', $validator->errors()->all());
            } else {
                list($first_name, $last_name) = explode(' ', $request->name);
                $objUser = User::firstOrNew(['id' => $request->user_id]);
                $objUser->first_name = $first_name;
                $objUser->last_name = $last_name;
                $objUser->email = $request->email;
                $objUser->postal_code = $request->postal_code;
                $objUser->city = $request->city;

                if ($request->profile_pic) {
                    $file = $request->profile_pic;
                    $file_name = Storage::disk('uploads')->put("user_profile", $file);
                    $objUser->profile_pic = $file_name;
                }
                if ($objUser->save()) {
                    $result['key'] = 1;
                    $result['message'] = "Profile Saved Successfully !";
                } else {
                    $result['key'] = 0;
                    $result['message'] = "Something went wrong !";
                }
            }
        } catch (Exception $e) {
            $result['key'] = 0;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result);
    }
}
