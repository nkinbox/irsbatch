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
            "cheque_number" => "required|min:1|max:".$size,
            "cheque_number.*" => "nullable|numeric|distinct|digits:6"
        ]);

        $loan = new Loan;
        $loan->loan_type = $request->loan_type;
        $loan->member_id = Auth::id();
        $loan->applied_on = date('Y-m-d');
        $loan->amount = $request->amount;
        $loan->save();
        $cheques = [];
        foreach($request->cheque_number as $number) {
            if($number != null) {
            $cheques[] = [
                "loan_id" => $loan->id,
                "number" => $number,
                "amount" => 0,
                "used_for" => "repayment"
            ];
            }
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
            "cheque_number" => "required|min:1|max:".$size,
            "cheque_number.*" => "nullable|numeric|distinct|digits:6|in:".$cheques,
        ]);
        $i = 0;
        $rule = [];
        foreach($request->cheque_number as $number) {
            if($number != null) {
            $temp_rule = [
                "cheque_amount.".$i => "required_with:cheque_number." .$i. "|numeric",
                "cheque_date.".$i => "required_with:cheque_number." .$i. "|date"
            ];
            $rule = array_merge($rule, $temp_rule);
            }
            $i++;
        }
        $request->validate($rule);
        $loan->status = "Pending";
        $Amount = 0.0;        
        foreach($request->cheque_number as $i => $number) {
            $where = [
                "loan_id" => $loan->id,
                "number" => $number
            ];
            $Amount += $request->cheque_amount[$i];
            $set = [
                "amount" => $request->cheque_amount[$i],
                "cheque_date" => date('Y-m-d', strtotime($request->cheque_date[$i])),
                "added_date" => date('Y-m-d')
            ];
            DB::table('cheques')->whereRaw('loan_id = ? and number = ?', $where)->update($set);
        }
        $loan->interest_amount = $Amount - $loan->amount;
        $loan->save();
        return redirect()->route('LoanRequest');
    }
    public function LoanStatus(Request $request) {
        $request->validate([
            "loan_id" => "required|numeric|exists:loans,id",
            "status" => "required|in:Rejected,Priority,Active"
        ]);
        $loan = Loan::find($request->loan_id);
        if($request->status == "Active") {
            if($loan->loan_incharge_id == null || $loan->cashier_id == null || $loan->corecommittee_id == null) {
                return redirect()->back()->with('error', 'Signature of LoanIncharge or Cashier or CoreCommittee is Missing.');
            }
            $loan->sanction_on = date('Y-m-d');
        }
        $loan->status = $request->status;
        $loan->save();
        return redirect()->back();
    }
    public function LoanPriorityView() {
        $loans = Loan::where('status', 'Priority')->with(['member_detail', 'repayment_cheques'])->get();
        //dd($loans->toArray());
        return view('Loan.LoanPriority', ['loans' => $loans]); 
    }
    public function LoanGiven() {
        $loans = Loan::where('status', 'Active')->with(['member_detail', 'repayment_cheques'])->get();
        //dd($loans->toArray());
        return view('Loan.LoanGiven', ['loans' => $loans]); 
    }
    public function LoanRequest() {
        $loans = Loan::where('status', 'Pending')->with(['member_detail', 'repayment_cheques'])->get();
        //dd($loans->toArray());
        return view('Loan.LHLoanApproval', ['loans' => $loans]);
    }
    public function LoanSignature(Request $request) {
        $request->validate([
            'id' => 'required|exists:loans',
            'signature' => 'required|image|max:2000',
            'sign_of' => 'required|in:loan_incharge_signature,cashier_signature,corecommittee_signature'
        ]);
        $loan = Loan::find($request->id);
        $photograph = null;
        if($request->hasFile('signature')) {
            $extn = $request->file('signature')->getClientOriginalExtension();
            $photograph = md5(str_random(20).time()) . '.' .$extn;
            $request->file('signature')->storeAs(
                'signature', $photograph
            );
        }
        switch($request->sign_of) {
            case "loan_incharge_signature":
            $loan->loan_incharge_id = Auth::id();
            $loan->loan_incharge_signature = $photograph;
            break;
            case "cashier_signature":
            $loan->cashier_id = Auth::id();
            $loan->cashier_signature = $photograph;
            break;
            case "corecommittee_signature":
            $loan->corecommittee_id = Auth::id();
            $loan->corecommittee_signature = $photograph;
        }
        $loan->save();
        return redirect()->back()->with('message', 'Operation Completed Successfully.');
    }
    public function ViewLoan($loan_id) {
        $loan = Loan::find($loan_id);
        if($loan == null)
        return redirect()->back();
        return view('Loan.LoanDetails', ['loan' => $loan]);
    }
    public function GiveLoanView($loan_id) {
        $loan = Loan::find($loan_id);
        if($loan == null)
        return redirect()->back();
        return view('Loan.GiveLoan', ['loan' => $loan]);
    }
    public function GiveLoan(Request $request) {
        $request->validate([
            "loan_id" => "required|numeric|exists:loans,id",
            "cheque_number.*" => "nullable|numeric|distinct|digits:6"
        ]);
        $i = 0;
        $rule = [];
        foreach($request->cheque_number as $number) {
            if($number != null) {
            $temp_rule = [
                "cheque_amount.".$i => "required_with:cheque_number." .$i. "|numeric",
                "cheque_date.".$i => "required_with:cheque_number." .$i. "|date"
            ];
            $rule = array_merge($rule, $temp_rule);
            }
            $i++;
        }
        $request->validate($rule);
        $loan = Loan::find($request->loan_id);
        $loan->given_on = date('Y-m-d');
        $loan->save();
        $insert = [];
        foreach($request->cheque_number as $i => $number) {
            $set = [
                "loan_id" => $request->loan_id,
                "number" => $number,
                "used_for" => "loan",
                "amount" => $request->cheque_amount[$i],
                "cheque_date" => date('Y-m-d', strtotime($request->cheque_date[$i])),
                "added_date" => date('Y-m-d')
            ];
            //DB::table('cheques')->whereRaw('loan_id = ? and number = ?', $where)->update($set);
            $insert[] = $set;
        }
        Cheque::insert($insert);
        return redirect()->route('LoanGiven');
    
    }
    public function repaymentView() {
        if(session('mode') == "member") {
            $where = [
                "member_id" => Auth::id(),
                "status" => "Active"
            ];
        } else {
            $where = [
                "status" => "Active"
            ];
        }
        $loans = Loan::where($where)->get();
        return view('Loan.LoanRepayment', ['loans' => $loans]);
    }
    public function repaymentStatus(Request $request) {
        $request->validate([
            "loan_id" => "required|numeric|exists:loans,id",
            "cheque_id" => "required|numeric|exists:cheques,id"
        ]);
        $cheque = Cheque::find($request->cheque_id);
        $cheque->status = 1;
        $cheque->save();
        $chqs = Cheque::where(["loan_id" => $request->loan_id, "used_for" => "repayment", "status" => 0])->count();
        if($chqs == 0) {
            $loan = Loan::find($request->loan_id);
            $loan->status = "Cleared";
            $loan->save();
        }
        return redirect()->back();
    }
}
