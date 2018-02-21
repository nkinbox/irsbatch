<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class MemberDetails extends Controller
{
    public function view($id) {
        $user = User::where('id', $id)->with('introduced_by', 'position')->first();
        if($user != null) {
            return $user;
        }
        return redirect()->back();
    }
    public function profile() {
        $id = Auth::id();
        $user = User::where('id', $id)->with('introduced_by', 'position')->first();
        if($user != null) {
            return view('Member.Profile')->with('member', $user);
        }
        return redirect()->back();
    }
    public function profileEditForm() {
        return view('Member.ProfileEdit');
    }
    public function profileEdit(Request $request) {
        return $request;
    }
}
