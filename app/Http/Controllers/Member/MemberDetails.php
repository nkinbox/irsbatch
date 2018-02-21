<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use App\Models\Documents;
use App\Rules\document;

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
        $request->validate([
            "address" => 'nullable|min:5|max:200',
            "mobile_no" => 'nullable|min:10|max:10',
            "whatsapp_no" => 'nullable|min:10|max:10',
            "docs_name.*" => 'sometimes|required_with:address|string|min:5|max:100',
            "docs" => ['sometimes|required_with:address,null', new document],
        ]);
        return $request;
    }
}
