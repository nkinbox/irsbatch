<?php

namespace App\Http\Controllers\API\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OfficeBearer;
use App\Models\User;

class OfficeBearerController extends Controller
{
    public function index() {
        $list = OfficeBearer::with('position_holder')->get();
        //return view('Administration.OfficeBearerList')->with('list', $list);
        return response()->json([
            "success" => "1",
            "list" => $list
        ]);
    }
    public function update(Request $request) {
        $request->validate([
            "position_id" => "required|numeric",
            "membership_code" => "exists:users"
        ]);
        $user = User::where("membership_code", $request->membership_code)->first();
        if($user != null) {
            $user->position_id = $request->position_id;
            $user->save();
        }
        return response()->json([
            "success" => "1",
            "message" => "Position Changed"
        ]);
    }
}
