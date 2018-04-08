<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Help;

class HelpController extends Controller
{
    public function HelpList() {
        if(session('mode') == "member")
        $list = Help::where(['member_id' => Auth::id()])
        ->with(['member_detail', 'corecommittee_detail'])->orderBy('created_at', 'desc')->paginate(20);
        else
        $list = Help::with(['member_detail', 'corecommittee_detail'])->orderBy('created_at', 'desc')->paginate(20);
        
        return view('Member.HelpList', ['list' => $list]);
    }
    public function getHelpForm() {
        return view('Member.Help');
    }
    public function getHelp(Request $request) {
        $request->validate([
            "help" => "required|in:Suspension,Removal,Dissmissal,Death",
            //"request_letter" => "required|file|mimetypes:application/pdf",
            //"offical_letter" => "required_unless:help,Death|nullable|file|mimetypes:application/pdf"
            "request_letter" => "required|file",
            "offical_letter" => "required_unless:help,Death|nullable|file"
        ]);
        $request_letter = null;
        if($request->hasFile('request_letter')) {
            $extn = $request->file('request_letter')->getClientOriginalExtension();
            $request_letter = md5(str_random(20).time()) . '.' .$extn;
            $request->file('request_letter')->storeAs(
                'documents', $request_letter
            );
        }
        $offical_letter = null;
        if($request->hasFile('offical_letter')) {
            $extn = $request->file('offical_letter')->getClientOriginalExtension();
            $offical_letter = md5(str_random(20).time()) . '.' .$extn;
            $request->file('offical_letter')->storeAs(
                'documents', $offical_letter
            );
        }
        $help = new Help;
        $help->member_id = Auth::id();
        $help->help = $request->help;
        $help->request_letter = $request_letter;
        $help->official_order = $offical_letter;
        $help->status = "Pending";
        $help->save();
        return redirect()->route('HelpList');
    }
    public function HelpAction(Request $request) {
        $request->validate([
            "help_id" => "required|exists:helps,id",
            "status" => "required|in:Accepted,Declined,Hold"
        ]);
        $help = Help::find($request->help_id);
        $help->corecommittee_id = Auth::id();
        $help->status = $request->status;
        $help->save();
        return redirect()->back();
    }
}
