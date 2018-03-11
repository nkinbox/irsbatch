<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Documents;
use App\Rules\document;
use App\Models\MembershipCancellation;
use Auth;

class AdmissionController extends Controller
{
    public function SignUpForm() {
        return view('Member.SignUp');
    }
    public function Pending() {
        $members = User::where('membership_status', 'pending')->get();
        $membership_code = null;
        if(count($members) > 0)
        $membership_code = $this->assign_membership_code($members[0]->applied_on);
        return view('Member.Pending', ['members' => $members, 'membership_code' => $membership_code]);
    }
    public function SignUp(Request $request) {
        $request->validate([
            "salutation" => 'required|string|max:5',
            "name" => 'required|string|min:2|max:100',
            "father_husband_name" => 'required|string|min:2|max:100',
            "designation" => 'required|string|min:2|max:40',
            "hq" => 'required|string|min:2|max:45',
            "address" => 'required|min:5|max:200',
            "dob" => 'required|date',
            "doa" => 'required|date',
            "dor" => 'required|date',
            "permanent_address" => 'required|min:5|max:200',
            "admission_cheque" => 'required|min:2|max:20',
            "cheque_amount" => 'required',
            "mobile_no" => 'required|min:10|max:10',
            "whatsapp_no" => 'required|min:10|max:10',
            "acc_no" => 'required|min:8|max:40',
            "ifsc_code" => 'required|min:11|max:11',
            "bank_name" => 'required|min:3|max:50',
            "branch_name" => 'required|min:5|max:50',
            "pan_card" => 'required|min:10|max:20',
            "id_number" => 'required|min:2|max:20',
            "railway_id" => 'required|min:2|max:45',
            "introduce_no" => 'nullable|exists:users,membership_code',
            "pf_no" => 'required|min:5|max:40',
            "blood_group" => 'required|numeric',
            "nominee_salutation" => "required|string|max:5",
            "nominee_name" => 'required|string|min:5|max:100',
            "relationship" => 'required|string|min:3|max:30',
            "nominee_phone" => 'required|min:10|max:10',
            //"nominee_acc_no" => 'required|max:40',
            //"nominee_ifsc_code" => 'required|max:20',
            //"nominee_bank_name" => 'required|max:50',
            //"nominee_branch_name" => 'required|max:50',
            "nominee_address" => 'required|min:5|max:200',
            "photograph" => 'required|image|min:2|max:2000',
            "nominee_photograph" => 'required|image|min:2|max:2000',
            "docs_name.*" => 'required|string|min:5|max:100',
            "docs" => ['required', new document],
        ]);
        $photograph = null;
        if($request->hasFile('photograph')) {
            $extn = $request->file('photograph')->getClientOriginalExtension();
            $photograph = md5(str_random(20).time()) . '.' .$extn;
            $request->file('photograph')->storeAs(
                'photograph', $photograph
            );
        }
        $nominee_photograph = null;
        if($request->hasFile('nominee_photograph')) {
            $extn = $request->file('nominee_photograph')->getClientOriginalExtension();
            $nominee_photograph = md5(str_random(20).time()) . '.' .$extn;
            $request->file('nominee_photograph')->storeAs(
                'photograph', $nominee_photograph
            );
        }
        $introduce_no = null;
        if($request->introduce_no != null) {
        $introduce_no = User::select('id')->where('membership_code', $request->introduce_no)->first();
        $introduce_no = $introduce_no->id;
        }
        switch($request->blood_group) {
            case 0:
            $blood_group = "A+";
            break;
            case 1:
            $blood_group = "A-";
            break;
            case 2:
            $blood_group = "B+";
            break;
            case 3:
            $blood_group = "B-";
            break;
            case 4:
            $blood_group = "O+";
            break;
            case 5:
            $blood_group = "O-";
            break;
            case 6:
            $blood_group = "AB+";
            break;
            case 7:
            $blood_group = "AB-";
        }
        $user = new User;
        $user->salutation = $request->salutation;
        $user->name = $request->name;
        $user->father_husband_name = $request->father_husband_name;
        $user->designation = $request->designation;
        $user->hq = $request->hq;
        $user->address = $request->address;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->doa = date('Y-m-d', strtotime($request->doa));
        $user->dor = date('Y-m-d', strtotime($request->dor));
        $user->permanent_address = $request->permanent_address;
        $user->admission_cheque = $request->admission_cheque;
        $user->cheque_amount = $request->cheque_amount;
        $user->mobile_no = $request->mobile_no;
        $user->whatsapp_no = $request->whatsapp_no;
        $user->acc_no = $request->acc_no;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->branch_name = $request->branch_name;
        $user->pan_card = $request->pan_card;
        $user->id_number = $request->id_number;
        $user->railway_id = $request->railway_id;
        $user->introduce_no = $introduce_no;
        $user->pf_no = $request->pf_no;
        $user->blood_group = $blood_group;
        $user->nominee_salutation = $request->nominee_salutation;
        $user->nominee_name = $request->nominee_name;
        $user->relationship = $request->relationship;
        $user->nominee_phone = $request->nominee_phone;
        //$user->nominee_acc_no = $request->nominee_acc_no;
        //$user->nominee_ifsc_code = $request->nominee_ifsc_code;
        $user->applied_on = date('Y-m-d');
        //$user->nominee_bank_name = $request->nominee_bank_name;
        //$user->nominee_branch_name = $request->nominee_branch_name;
        $user->nominee_address = $request->nominee_address;
        $user->photograph = $photograph;
        $user->nominee_photograph = $nominee_photograph;
        $user->save();

        if(count($request->docs) > 0) {
        foreach($request->docs as $key => $docs) {
            foreach($docs as $doc) {
                $extn = $doc->getClientOriginalExtension();
                $document = md5(str_random(20).time()) . '.' .$extn;
                $doc->storeAs(
                    'documents', $document
                );
                $docname = $request->docs_name[$key];
                $documents[] = array("member_id" => $user->id, "document_name" => $docname, "file_name" => $document, "uploaded_on" => date("Y-m-d"));
            }
        }
        Documents::insert($documents);
        }
        return redirect('home')->with('status',"Member Details sent for Approval Successfully.");
    }
    public function ShowApplication($id) {
        $member = User::where('id', $id)->with('documents')->first();
        //return $member;
        if(is_null($member))
        return redirect()->back()->with('error', 'No Application Selected');
        return view('Member.Profile')->with('member', $member);
    }
    public function ApplicationStatus(Request $request) {
        $request->validate([
            "id" => "required|exists:users",
            "status" => "required|in:rejected,accepted"
        ]);
        $member = User::find($request->id);
        if(is_null($member->adm_incharge) || is_null($member->cashier) || is_null($member->vice_president)) {
            return redirect()->back()->with('error', 'Not Approved By ADM. Incharge / Cashier / Vice President Yet');
        }
        $membership_code = null;
        $membership = 0;
        if($request->status == "accepted") {
            $membership_code = $this->assign_membership_code($member->applied_on);
            $membership = 1;
        }
        $member->membership = $membership;
        $member->membership_code = $membership_code;
        $member->membership_status = $request->status;
        $member->approved_on = date('Y-m-d');
        $member->save();
        return redirect()->back()->with('message', 'Success! Application Processed Successfully.');
    }
    public function addSignature(Request $request) {
        $request->validate([
            'id' => 'required|exists:users',
            'signature' => 'required|image|max:2000',
            'sign_of' => 'required|in:adm_incharge,cashier,vice_president',
        ]);
        $member = User::find($request->id);
        $photograph = null;
        if($request->hasFile('signature')) {
            $extn = $request->file('signature')->getClientOriginalExtension();
            $photograph = md5(str_random(20).time()) . '.' .$extn;
            $request->file('signature')->storeAs(
                'signature', $photograph
            );
        }
        //dd(is_null(is_null($member->adm_incharge) || is_null($member->cashier)));
        $error = false;
        switch($request->sign_of) {
            case "adm_incharge":
            $member->adm_incharge = $photograph;
            break;
            case "cashier":
            if(is_null($member->adm_incharge))
            $error = "Not Approved By ADM. Incharge Yet";
            else
            $member->cashier = $photograph;
            break;
            case "vice_president":
            if(is_null($member->adm_incharge) || is_null($member->cashier))
            $error = "Not Approved By ADM. Incharge or Cashier Yet";
            else
            $member->vice_president = $photograph;
        }
        if(!$error) {
        $member->save();
        return redirect()->back()->with('message', 'Operation Completed Successfully.');
        }
        return redirect()->back()->with('error', $error);
    }
    private function assign_membership_code($date) {
        $code = '';
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        switch($month) {
            case $month<4:
            $start = $year. "-01-01";
            $end = $year. "-03-31";
            break;
            case $month<7:
            $start = $year. "-04-01";
            $end = $year. "-06-30";
            break;
            case $month<10:
            $start = $year. "-07-01";
            $end = $year. "-09-30";
            break;
            default:
            $start = $year. "-10-01";
            $end = $year. "-12-31";
        }
        $count = User::where('membership_status', 'accepted')
        ->whereBetween('applied_on',[$start,$end])->count();
        
        $count++;
        $count = sprintf('%03d', $count);
        switch($month) {
            case $month<4:
            $code = $year.'A'.$count;
            break;
            case $month<7:
            $code = $year.'B'.$count;
            break;
            case $month<10:
            $code = $year.'C'.$count;
            break;
            default:
            $code = $year.'D'.$count;
        }
        return $code;
    }
    public function Cancel(Request $request) {
        if(empty($request->all())) {
            return view('Member.Cancel');
        } else {
            $request->validate([
                "reason" => "required|string|min:10|max:2500",
                "signature" => "required|image|min:2|max:2000",
                "letter" => "required|file|mimetypes:application/pdf"
            ]);
            $mc = MembershipCancellation::where([
                'member_id' => Auth::id(),
                'status' => 'pending'
                ])->first();
            if($mc != null) {
                return redirect()->route('MembershipCancellation')->with('e_message', 'Cancellation Already Submitted.');
            }
            $signature = null;
            if($request->hasFile('signature')) {
                $extn = $request->file('signature')->getClientOriginalExtension();
                $signature = md5(str_random(20).time()) . '.' .$extn;
                $request->file('signature')->storeAs(
                    'signature', $signature
                );
            }
            $letter = null;
            if($request->hasFile('letter')) {
                $extn = $request->file('letter')->getClientOriginalExtension();
                $letter = md5(str_random(20).time()) . '.' .$extn;
                $request->file('letter')->storeAs(
                    'documents', $letter
                );
            }
            $mc = new MembershipCancellation;
            $mc->member_id = Auth::id();
            $mc->reason = $request->reason;
            $mc->signature = $signature;
            $mc->letter = $letter;
            $mc->save();
            return redirect()->route('MembershipCancellation')->with('message', 'Membership Cancellation Request Sent Successfully.');
        }
    }
    public function CancellationList() {
        $user = Auth::user();
        //dd($user);
        if($user->position_id == 11) {
            $cancellationList = MembershipCancellation::whereIn('status', ['pending', 'hold'])
            ->where('lobbyhead', null)
            ->whereHas('member_detail', function ($query) use ($user) {
                $query->where('hq', $user->hq);
            })
            ->with(['member_detail', 'lobbyhead_detail', 'corecommittee_detail'])->get();
        } else {
            $cancellationList = MembershipCancellation::whereIn('status', ['pending', 'hold'])
            ->where("lobbyhead", "!=", null)
            ->with(['member_detail', 'lobbyhead_detail', 'corecommittee_detail'])->get();
        }
        //dd($cancellationList);
        return view('Administration.CancellationList', ['list' => $cancellationList]);
    }
    public function CancellationStatus(Request $request) {
        $request->validate([
            "cancel_id" => "required|exists:membership_cancellations,id",
            "lobbyhead" => "required|boolean",
            "status" => "required|in:declined,approved,hold,pending"
        ]);
        if($request->lobbyhead) {
            $cancel = MembershipCancellation::find($request->cancel_id);
            $cancel->lobbyhead = Auth::id();
            $cancel->status = $request->status;
            $cancel->save();
        } else {
            $cancel = MembershipCancellation::find($request->cancel_id);
            $cancel->corecommittee = Auth::id();
            $cancel->status = $request->status;
            $cancel->save();
            if($request->status == "approved") {
                $user = User::find($cancel->member_id);
                $user->membership = 0;
                $user->membership_status = "suspended";
                $user->save();
            }
        }
        return redirect()->back();
    }
}
