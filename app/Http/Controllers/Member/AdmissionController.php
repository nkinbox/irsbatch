<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Documents;
use App\Rules\document;

class AdmissionController extends Controller
{   
    public function SignUpForm() {
        return view('Member.SignUp');
    }
    public function UpdateForm() {
        
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
            "name" => 'required|string|max:100',
            "father_husband_name" => 'required|string|max:100',
            "designation" => 'required|string|max:40',
            "hq" => 'required|string|max:45',
            "address" => 'required|max:200',
            "dob" => 'required|date',
            "doa" => 'required|date',
            "dor" => 'required|date',
            "permanent_address" => 'required|max:200',
            "mobile_no" => 'required|max:10',
            "acc_no" => 'required|max:40',
            "ifsc_code" => 'required|max:20',
            "bank_name" => 'required|max:50',
            "branch_name" => 'required|max:50',
            "pan_card" => 'required|max:20',
            "id_number" => 'required|max:20',
            "railway_id" => 'required|max:45',
            "introduce_no" => 'nullable|exists:users,membership_code',
            "pf_no" => 'required|max:40',
            "nominee_salutation" => "required|string|max:5",
            "nominee_name" => 'required|string|max:100',
            "relationship" => 'required|string|max:30',
            "nominee_phone" => 'required|max:10',
            "nominee_acc_no" => 'required|max:40',
            "nominee_ifsc_code" => 'required|max:20',
            "nominee_bank_name" => 'required|max:50',
            "nominee_branch_name" => 'required|max:50',
            "nominee_address" => 'required|max:200',
            "photograph" => 'required|image|max:2000',
            "nominee_photograph" => 'required|image|max:2000',
            "docs_name.*" => 'required|string|max:100',
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
        $user->mobile_no = $request->mobile_no;
        $user->acc_no = $request->acc_no;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->branch_name = $request->branch_name;
        $user->pan_card = $request->pan_card;
        $user->id_number = $request->id_number;
        $user->railway_id = $request->railway_id;
        $user->introduce_no = $introduce_no;
        $user->pf_no = $request->pf_no;
        $user->nominee_salutation = $request->nominee_salutation;
        $user->nominee_name = $request->nominee_name;
        $user->relationship = $request->relationship;
        $user->nominee_phone = $request->nominee_phone;
        $user->nominee_acc_no = $request->nominee_acc_no;
        $user->nominee_ifsc_code = $request->nominee_ifsc_code;
        $user->applied_on = date('Y-m-d');
        $user->nominee_bank_name = $request->nominee_bank_name;
        $user->nominee_branch_name = $request->nominee_branch_name;
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
                $documents[] = array("member_id" => $user->id, "document_name" => $docname, "file_name" => $document);
            }
        }
        Documents::insert($documents);
        }
        return redirect('home')->with('status',"Member Details sent for Approval Successfully.");
    }
    public function Update() {

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
        $count = User::where('membership_status', 'accepted')
        ->whereMonth('applied_on', $month)
        ->whereYear('applied_on', $year)->count();
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
}
