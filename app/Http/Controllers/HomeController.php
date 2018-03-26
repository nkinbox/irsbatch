<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\MembershipFees;
use Auth;

class HomeController extends Controller
{
    public function index()
    {   $data = [];
        if(session('mode') == "member") {
            $data['membership_fees'] = MembershipFees::where(['member_id' => Auth::id()])->sum('paid_amount');
            $loan = Loan::where(['member_id' => Auth::id()])->with('repayment_cheques')->get();
            dd($loan);
            $data['loan_repayment'] = $loan;
        }
        return view('home', ['data' => $data]);
    }
}
