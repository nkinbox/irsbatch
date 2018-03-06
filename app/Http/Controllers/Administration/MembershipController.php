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
        if($user->position_id == 11 && session('mode') == "lobbyhead") {
        $where = ['membership' => 1, 'hq' => $user->hq];
        }
        elseif(session('mode') == "member")
        $where = ['id' => $user->id, 'membership' => 1];
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
    }/*
    public function verifyTransfer(Request $request) {
        $request->validate([
            "fees_id" => "required|exists:membership_fees,id"
        ]);
        $id = MembershipFees::find($request->fees_id);
        if(($id->pay_method == "TRANSFER" || $id->pay_method == "CHEQUE") && $id->status == "unverified") {
            $id->status = "success";
            $id->save();
        }
        return redirect()->back();
    }*/
    public function LHMembershipCollectionForm($id = null) {        
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
        return view('Membership.MembershipCollectionView', ['fees_' => $fees, 'month' => $request->month, 'year' => $request->year]);
    }
    public function LHMembershipCollection(Request $request) {
        $request->validate([
            "membership_code" => "required|string|exists:users",
            "pay_method" => "required|string|in:CASH,CHEQUE",
            "paid_amount" => "required|numeric",
            "cheque_number" => "required_if:pay_method,CHEQUE|nullable|numeric|digits:6",
            "cheque_date" => "required_if:pay_method,CHEQUE|nullable|date"
        ]);
        return $request;
    }
    public function ChequeStatusForm() {

    }
    public function ChequeStatus() {

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
