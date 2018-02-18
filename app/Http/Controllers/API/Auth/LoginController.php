<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'membership_code' => 'required|string|max:10',
            'mobile_no' => 'required|digits:10',
            'password' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $user = User::where([
            "membership_code" => $request->membership_code,
            "mobile_no" => $request->mobile_no,
            "membership" => 1
        ])->first();
        if($user != null) {            
            if(is_null($request->password)) {
                $otp = "1234";
                $user->password = bcrypt($otp);
                $user->save();
                return response()->json(array(
                    "success" => "1",
                    "message" => "OTP Sent on " .substr($request->mobile_no, 0, 2). "xxxxxx" .substr($request->mobile_no, -2, 2). ".",
                 ));
            } elseif(Hash::check($request->password, $user->getAuthPassword())) {
                //$token = bcrypt($request->membership_code . time());
                $token = "token";
                $user->api_token = $token;
                $user->save();
                return response()->json(array(
                "success" => "1",
                "message"=>"loggedin",
                "api_token" => $token
                ));
            } else {
                return response()->json(array("success"=>"0","message"=>"Invalid Credentials"));
            }
        } else {
            return response()->json(array("success"=>"0","message"=>"Invalid Credentials"));
        }
    }
    public function logout()
    {   
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        return response()->json(array("success"=>"1","message"=>"Logged Out"));
    }
}
