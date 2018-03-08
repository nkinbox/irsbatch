<?php

namespace App\Http\Controllers\API\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MembershipFees;
use App\Models\Cheque;
use Auth;

class MembershipController extends Controller
{
    public function MembershipDetails(Request $request) {
        $user = Auth::user();
        if($user->position_id == 11 && $request->mode == "lobbyhead") {
        $where = ['membership' => 1, 'hq' => $user->hq];
        }
        elseif($request->mode == "member")
        $where = ['id' => $user->id, 'membership' => 1];
        else
        $where = ['membership' => 1];
        if(!empty($request->month) && !empty($request->year))
        $binding = [$request->month, $request->year];
        else
        $binding = [date('m'),date('Y')];
        $members = User::where($where)->with(['membership_fees'=>function($query) use ($binding){
            $query->whereRaw("fees_month = ? and fees_year = ?", $binding)->with('paid_to')->with('verifier')->with('cheque_detail');
        }])->get();
        //dd($members);
        return response()->json(['success' => '1', 'members' => $members, 'month' => $request->month, 'year' => $request->year]);
    }
    public function LHMembershipCollectionForm() {
        return view('Membership.MembershipCollectionForm');
    }
    public function LHMembershipCollectionView(Request $request) {
        $id = Auth::id();
        if(!empty($request->month) && !empty($request->year)) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        $fees = MembershipFees::where('given_to', $id)->whereMonth('pay_date', $month)->whereYear('pay_date', $year)->with('member_detail')->get();
        return response()->json(['success' => '1', 'fees' => $fees, 'month' => $request->month, 'year' => $request->year]);
    }
    public function LHMembershipCollection(Request $request) {
        $request->validate([
            "membership_code" => "required|string|exists:users",
            "pay_method" => "required|string|in:CASH,CHEQUE",
            "paid_amount" => "required|numeric",
            "cheque_number" => "required_if:pay_method,CHEQUE|nullable|numeric|digits:6",
            "cheque_date" => "required_if:pay_method,CHEQUE|nullable|date"
        ]);
        $member = User::select('id')->where('membership_code', $request->membership_code)->first();
        $mf_ = MembershipFees::where([
            "member_id" => $member->id,
            "fees_month" => date('m'),
            "fees_year" => date('Y')
        ])->first();
        if($mf_ != null) {
            return response()->json([
                "success" => "0",
                "message" => 'Membership Fees Already Paid By '.$request->membership_code
            ]);
        }
        $mf = new MembershipFees;
        $mf->member_id = $member->id;
        $mf->fees_amount = $request->paid_amount;
        $mf->paid_amount = $request->paid_amount;
        $mf->fees_month = date('m');
        $mf->fees_year = date('Y');
        $mf->pay_date = date('Y-m-d');
        $mf->pay_method = $request->pay_method;
        $mf->given_to = Auth::id();

       if($request->pay_method =="CHEQUE") {
        $mf->status = "unverified";
        $cheque = new Cheque;
        $cheque->number = $request->cheque_number;
        $cheque->amount = $request->paid_amount;
        $cheque->cheque_date = $request->cheque_date;
        $cheque->added_date = date('Y-m-d');
        $cheque->save();
        $mf->cheque_id = $cheque->id;
       } else {
        $mf->status = "success";
       }
       $mf->save();
       return response()->json([
           "success" => "1",
           "message" => "Success! Fee Collection Added"
       ]);
    }
    public function MembershipVerify(Request $request) {
        $request->validate([
            "fees_id" => "required|exists:membership_fees,id",
            "status" => "required|in:success,reject"
        ]);
        $mf = MembershipFees::find($request->fees_id);
        $mf->verified_by = Auth::id();
        if($request->status == "success") {
            $mf->status = "success";
            if($mf->pay_method == "CHEQUE") {
            $cheque = Cheque::find($mf->cheque_id);
            $cheque->status = 1;
            $cheque->save();
            }
        } else {
            $mf->status = "pending";
        }
        $mf->save();
        return response()->json([
            "success" => "1",
            "message" => "Verified Successfully."
        ]);
    }
    public function pay_membership_form() {
        $bool = false;
        $mf_ = MembershipFees::where([
            "member_id" => Auth::id(),
            "fees_month" => date('m'),
            "fees_year" => date('Y')
        ])->first();
        if($mf_ != null)
        $bool = true;
        return view('Membership.PayMembership', ['bool' => $bool]);
    }
    public function pay_membership(Request $request) {
        $request->validate([
            "pay_method" => "required|in:TRANSFER,ONLINE",
            "receipt" => "required_if:pay_method,TRANSFER|nullable|image|min:2|max:20000"
        ]);
        if($request->hasFile('receipt')) {
            $extn = $request->file('receipt')->getClientOriginalExtension();
            $receipt = md5(str_random(20).time()) . '.' .$extn;
            $request->file('receipt')->storeAs(
                'receipts', $receipt
            );
        }
        $mf = new MembershipFees;
        $mf->member_id = Auth::id();
        $mf->fees_amount = 1000;
        $mf->paid_amount = 1000;
        $mf->fees_month = date('m');
        $mf->fees_year = date('Y');
        $mf->pay_date = date('Y-m-d');
        $mf->pay_method = $request->pay_method;
        if($request->pay_method == "TRANSFER") {
            $mf->status = "unverified";
            $mf->receipt_file = $receipt;
            $mf->save();
            return redirect()->route('MembershipDetails');
        } else {
            //$txn = new PAYUMONEY;
            $mf->status = null;
            $mf->txn_id = "0";//$txn->id;
            $mf->save();
            return "Redirect to PayUMoney";
        }
    }
    public function TransferReceiptUploadForm() {

    }
    public function TransferReceiptUpload() {

    }
    public function PayUMoneyProcess() {

    }
    public function PayUMoneyResponse() {

    }
}
