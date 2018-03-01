<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MembershipFees;
use Auth;

class MembershipController extends Controller
{
    public function MembershipDetails(Request $request) {
        $user = Auth::user();
        if($user->position_id == 11)
        $where = ['membership' => 1, 'hq' => $user->hq];
        else
        $where = ['membership' => 1];
        if(!empty($request->month) && !empty($request->year))
        $binding = [$request->month, $request->year];
        else
        $binding = [date('m'),date('Y')];
        $members = User::where($where)->with(['membership_fees'=>function($query) use ($binding){
            $query->whereRaw("month(`pay_date`) = ? and year(`pay_date`) = ?", $binding);
        }])->get();
        //dd($members);
        return view('Membership.MembershipDetails', ['members' => $members, 'month' => $request->month, 'year' => $request->year]);
    }
}
