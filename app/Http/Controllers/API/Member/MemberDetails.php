<?php

namespace App\Http\Controllers\API\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use App\Models\Documents;
use App\Rules\document;

class MemberDetails extends Controller
{
    public function View(Request $request) {
        $request->validate([
            "member_id" => "required|exists:users,id"
        ]);
        $user = User::where('id', $request->member_id)->with('introduced_by', 'position')->first();
        return response()->json([
            "success" => "1",
            "member" => $user
        ]);
    }
    public function profile() {
        $id = Auth::id();
        $user = User::where('id', $id)->with('introduced_by', 'position')->first();
        if($user != null) {
            return response()->json([
                "success" => "1",
                "member" => $user
            ]);
        }
        return response()->json([
            "success" => "0",
            "message" => "An Unidentified Error Occured"
        ]);
    }/*
    public function profileEditForm() {
        return view('Member.ProfileEdit');
    }*/
    public function profileEdit(Request $request) {
        if($request->address != null) {
            $request->validate([
                "address" => 'required|min:5|max:200',
                "mobile_no" => 'nullable|min:10|max:10',
                "whatsapp_no" => 'nullable|min:10|max:10',
                "docs_name.*" => 'required|string|min:5|max:100',
                "docs" => ['required', new document],
            ]);
        } else {
            $request->validate([
                "mobile_no" => 'nullable|min:10|max:10',
                "whatsapp_no" => 'nullable|min:10|max:10',
            ]);
        }
        $id = Auth::id();
        $user = User::find($id);
        $save = false;
        if($request->address != null) {
        if(count($request->docs) > 0) {
            $save = true;
            $user->address = $request->address;
            foreach($request->docs as $key => $docs) {
                foreach($docs as $doc) {
                    $extn = $doc->getClientOriginalExtension();
                    $document = md5(str_random(20).time()) . '.' .$extn;
                    $doc->storeAs(
                        'documents', $document
                    );
                    $docname = $request->docs_name[$key];
                    $documents[] = array("member_id" => $id, "document_name" => $docname, "file_name" => $document, "uploaded_on" => date("Y-m-d"));
                }
            }
            Documents::insert($documents);
            }
        }
        if($request->mobile_no != null) {
            $save = true;
            $user->mobile_no = $request->mobile_no;
        }
        if($request->whatsapp_no != null) {
            $save = true;
            $user->whatsapp_no = $request->whatsapp_no;
        }
        if($save)
        $user->save();
        return response()->json([
            "success" => "1",
            "message" => "Profile Updated Successfully"
        ]);
    }/*
    public function nomineeEditForm() {
        $id = Auth::id();
        $nominee = User::find($id);
        return view('Member.NomineeEdit')->with('nominee', $nominee);
    }*/
    public function nomineeEdit(Request $request) {
        $request->validate([
            "nominee_salutation" => "required|string|max:5",
            "nominee_name" => 'required|string|min:5|max:100',
            "relationship" => 'required|string|min:3|max:30',
            "nominee_phone" => 'required|min:10|max:10',
            //"nominee_acc_no" => 'required|max:40',
            //"nominee_ifsc_code" => 'required|max:20',
            //"nominee_bank_name" => 'required|max:50',
            //"nominee_branch_name" => 'required|max:50',
            "nominee_address" => 'required|min:5|max:200',
            "nominee_photograph" => 'nullable|image|min:2|max:2000',
        ]);
        $nominee_photograph = null;
        if($request->hasFile('nominee_photograph')) {
            $extn = $request->file('nominee_photograph')->getClientOriginalExtension();
            $nominee_photograph = md5(str_random(20).time()) . '.' .$extn;
            $request->file('nominee_photograph')->storeAs(
                'photograph', $nominee_photograph
            );
        }
        $id = Auth::id();
        $user = User::find($id);
        $user->nominee_salutation = $request->nominee_salutation;
        $user->nominee_name = $request->nominee_name;
        $user->relationship = $request->relationship;
        $user->nominee_phone = $request->nominee_phone;
        $user->nominee_address = $request->nominee_address;
        if($nominee_photograph != null)
        $user->nominee_photograph = $nominee_photograph;
        $user->save();
        return response()->json([
            "success" => "1",
            "message" => "Nominee Updated Successfully"
        ]);
    }/*
    public function bankEditForm() {
        return view('Member.BankEdit');
    }
    public function nomineeBankEditForm() {
        return view('Member.NomineeBankEdit');
    }*/
    public function bankEdit(Request $request) {
        $request->validate([
            "acc_no" => 'required|min:8|max:40',
            "ifsc_code" => 'required|min:11|max:11',
            "bank_name" => 'required|min:3|max:50',
            "branch_name" => 'required|min:5|max:50',
        ]);
        $id = Auth::id();
        $user = User::find($id);
        $user->acc_no = $request->acc_no;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->branch_name = $request->branch_name;
        $user->save();
        return response()->json([
            "success" => "1",
            "message" => "Bank Updated Successfully"
        ]);
    }
    public function nomineeBankEdit(Request $request) {
        $request->validate([
            "nominee_acc_no" => 'required|min:8|max:40',
            "nominee_ifsc_code" => 'required|min:11|max:11',
            "nominee_bank_name" => 'required|min:3|max:50',
            "nominee_branch_name" => 'required|min:5|max:50',
        ]);
        $id = Auth::id();
        $user = User::find($id);
        $user->nominee_acc_no = $request->nominee_acc_no;
        $user->nominee_ifsc_code = $request->nominee_ifsc_code;
        $user->nominee_bank_name = $request->nominee_bank_name;
        $user->nominee_branch_name = $request->nominee_branch_name;
        $user->save();
        return response()->json([
            "success" => "1",
            "message" => "Nominee Bank Updated Successfully"
        ]);
    }
    public function memberDetails() {
        $user = Auth::user();
        if($user->position_id == 11)
        $users = User::where(['membership' => 1, 'hq' => $user->hq])->paginate(20);
        else
        $users = User::where('membership', 1)->paginate(20);
        return response()->json([
            "success" => "1",
            "members" => $users
        ]);
    }/*
    public function EditForm($id) {
        $user = User::where('id', $id)->with('introduced_by', 'position')->first();
        if($user != null) {
            return view('Member.MemberEdit')->with('member', $user);
        }
        return redirect()->back();
    }*/
    public function Edit(Request $request) {
        $request->validate([
            "id" => 'required|exists:users',
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
            "mobile_no" => 'required|min:10|max:10',
            "whatsapp_no" => 'required|min:10|max:10',
            "acc_no" => 'required|min:8|max:40',
            "ifsc_code" => 'required|min:11|max:11',
            "bank_name" => 'required|min:3|max:50',
            "branch_name" => 'required|min:5|max:50',
            "pan_card" => 'required|min:10|max:20',
            "id_number" => 'required|min:2|max:20',
            "railway_id" => 'required|min:2|max:45',
            "pf_no" => 'required|min:5|max:40',
            "nominee_salutation" => "required|string|max:5",
            "nominee_name" => 'required|string|min:5|max:100',
            "relationship" => 'required|string|min:3|max:30',
            "nominee_phone" => 'required|min:10|max:10',
            "nominee_acc_no" => 'required|min:8|max:40',
            "nominee_ifsc_code" => 'required|min:11|max:11',
            "nominee_bank_name" => 'required|min:3|max:50',
            "nominee_branch_name" => 'required|min:5|max:50',
            "nominee_address" => 'required|min:5|max:200',
            "photograph" => 'nullable|image|min:2|max:2000',
            "nominee_photograph" => 'nullable|image|min:2|max:2000',
            "docs_name.*" => 'required_with:docs|string|min:5|max:100',
            "docs" => ['required_with:docs_name', new document],
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

        $user = User::find($request->id);
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
        //$user->admission_cheque = $request->admission_cheque;
        //$user->cheque_amount = $request->cheque_amount;
        $user->mobile_no = $request->mobile_no;
        $user->whatsapp_no = $request->whatsapp_no;
        $user->acc_no = $request->acc_no;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->branch_name = $request->branch_name;
        $user->pan_card = $request->pan_card;
        $user->id_number = $request->id_number;
        $user->railway_id = $request->railway_id;
        //$user->introduce_no = $introduce_no;
        $user->pf_no = $request->pf_no;
        //$user->blood_group = $blood_group;
        $user->nominee_salutation = $request->nominee_salutation;
        $user->nominee_name = $request->nominee_name;
        $user->relationship = $request->relationship;
        $user->nominee_phone = $request->nominee_phone;
        $user->nominee_acc_no = $request->nominee_acc_no;
        $user->nominee_ifsc_code = $request->nominee_ifsc_code;
        //$user->applied_on = date('Y-m-d');
        $user->nominee_bank_name = $request->nominee_bank_name;
        $user->nominee_branch_name = $request->nominee_branch_name;
        $user->nominee_address = $request->nominee_address;
        if($photograph != null)
        $user->photograph = $photograph;
        if($nominee_photograph != null)
        $user->nominee_photograph = $nominee_photograph;
        $user->save();

        if($request->docs != null && count($request->docs) > 0) {
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
        return redirect()->route('MemberDetails');
    }
}
