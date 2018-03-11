<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Cheque;
use App\Models\User;
use Auth;
use DB;

class LoanController extends Controller
{
    public function LoanForm() {
        return view('Loan.ApplyForm');
    }
    public function AddLoan(Request $request) {
        $request->validate([
            "loan_range" => "required|numeric|min:1|max:6",
        ]);
        if($request->loan_range == 1) {
            $validation = "min:1|max:49000";
            $size = "5";
        } elseif($request->loan_range == 2) {
            $validation = "min:50000|max:99999";
            $size = "10";
        } elseif($request->loan_range == 3) {
            $validation = "min:100000|max:149999";
            $size = "12";
        } elseif($request->loan_range == 4) {
            $validation = "min:150000|max:199999";
            $size = "15";
        } elseif($request->loan_range == 5) {
            $validation = "min:200000|max:299999";
            $size = "20";
        } elseif($request->loan_range == 6) {
            $validation = "min:300000";
            $size = "25";
        }
        $request->validate([
            "loan_type" => "required|in:Normal,Emergency",
            "amount" => "required|numeric|".$validation,
            "cheque_number" => "required|size:".$size,
            "cheque_number.*" => "required|numeric|distinct|digits:6"
        ]);

        $loan = new Loan;
        $loan->loan_type = $request->loan_type;
        $loan->member_id = Auth::id();
        $loan->applied_on = date('Y-m-d');
        $loan->amount = $request->amount;
        $loan->save();
        $cheques = [];
        foreach($request->cheque_number as $number) {
            $cheques[] = [
                "loan_id" => $loan->id,
                "number" => $number,
                "amount" => 0,
                "used_for" => "repayment"
            ];
        }
        Cheque::insert($cheques);
        return redirect()->route('LoanPriority');
    }
    public function ChequeCollectionForm() {
        return view('Loan.ChequeCollection');
    }
    public function ChequeCollection(Request $request) {
        $request->validate([
            "loan_range" => "required|numeric|min:1|max:6",
            "membership_code" => "required|string|exists:users",
        ]);
        if($request->loan_range == 1) {
            $validation = "min:1|max:49000";
            $size = "5";
        } elseif($request->loan_range == 2) {
            $validation = "min:50000|max:99999";
            $size = "10";
        } elseif($request->loan_range == 3) {
            $validation = "min:100000|max:149999";
            $size = "12";
        } elseif($request->loan_range == 4) {
            $validation = "min:150000|max:199999";
            $size = "15";
        } elseif($request->loan_range == 5) {
            $validation = "min:200000|max:299999";
            $size = "20";
        } elseif($request->loan_range == 6) {
            $validation = "min:300000";
            $size = "25";
        }
        $member = User::where('membership_code', $request->membership_code)->first();
        $loan = Loan::where([
            'member_id' => $member->id,
            "status" => "temp"
            ])->with('repayment_cheques')->first();
        $cheques = implode(",", array_column($loan->repayment_cheques->toArray(), 'number'));
        $request->validate([
            "loan_type" => "required|in:".$loan->loan_type,
            "amount" => "required|numeric|in:".$loan->amount,
            "cheque_number" => "required|size:".$size,
            "cheque_amount" => "required|size:".$size,
            "cheque_date" => "required|size:".$size,
            "cheque_number.*" => "required|numeric|distinct|digits:6|in:".$cheques,
            "cheque_amount.*" => "required|numeric",
            "cheque_date.*" => "required|date"
        ]);

        $loan->status = "Priority";
        $loan->save();
        foreach($request->cheque_number as $i => $number) {
            $where = [
                "loan_id" => $loan->id,
                "number" => $number
            ];
            $set = [
                "amount" => $request->cheque_amount[$i],
                "cheque_date" => date('Y-m-d', strtotime($request->cheque_date[$i])),
                "added_date" => date('Y-m-d')
            ];
            DB::table('cheques')->whereRaw('loan_id = ? and number = ?', $where)->update($set);
        }
        return redirect()->route('LoanRequest');
    }
    public function LoanPriority() {
        return "hi";
    }
    public function LoanRequest() {
        $loans = Loan::where('status', 'Pending')->with('member_detail')->get();
        return view('Loan.LHLoanApproval', ['loans' => $loans]);
    }
}