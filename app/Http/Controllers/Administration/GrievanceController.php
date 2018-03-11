<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grievance;
use Auth;

class GrievanceController extends Controller
{
    public function all() {
        $user = Auth::user();
        if($user->position_id == 0) {
            $list = Grievance::where('member_id', $user->id)->get();
        } elseif($user->position_id == 11) {
            $list = Grievance::where('stage', 'LobbyHead')->whereHas('member_detail', function($query) use($user) {
                $query->where('hq', $user->hq);
            })->get();
        } elseif($user->position_id == 1) {
            $list = Grievance::where('stage', 'President')->get();
        } else {
            $list = Grievance::where('stage', 'CoreCommittee')->get();
        }        
        return view('Member.Grievance', ['list' => $list]);
    }
    public function addView() {
        return view('Member.NewGrievance');
    }
    public function add(Request $request) {
        $request->validate([
            "member_text" => "required|string|min:50|max:2000",
            "member_signature" => "required|image|min:2|max:2000",
            "docs" => "sometimes|file|mimetypes:application/pdf"
        ]);
        $signature = null;
        if($request->hasFile('member_signature')) {
            $extn = $request->file('member_signature')->getClientOriginalExtension();
            $signature = md5(str_random(20).time()) . '.' .$extn;
            $request->file('member_signature')->storeAs(
                'signature', $signature
            );
        }
        $docs = null;
        if($request->hasFile('docs')) {
            $extn = $request->file('docs')->getClientOriginalExtension();
            $docs = md5(str_random(20).time()) . '.' .$extn;
            $request->file('docs')->storeAs(
                'documents', $docs
            );
        }
        $g = new Grievance;
        $g->stage = "LobbyHead";
        $g->member_id = Auth::id();
        $g->file_name = $docs;
        $g->member_signature = $signature;
        $g->member_text = $request->member_text;
        $g->save();
        return redirect()->route('Grievance');
    }
    public function show($id) {
        $g = Grievance::find($id);
        return view('Member.GrievanceAction', ['g' => $g]);
    }
    public function action(Request $request) {
        $request->validate([
            "id" => "required|exists:grievances",
        ]);
        $g = Grievance::find($request->id);
        if($g->stage == "LobbyHead" && Auth::user()->position_id == 11) {
            $request->validate([
                "lh_text" => "nullable|string|min:50|max:2000",
                "lobbyhead_signature" => "required|image|min:2|max:2000",
            ]);
            $signature = null;
            if($request->hasFile('lobbyhead_signature')) {
                $extn = $request->file('lobbyhead_signature')->getClientOriginalExtension();
                $signature = md5(str_random(20).time()) . '.' .$extn;
                $request->file('lobbyhead_signature')->storeAs(
                    'signature', $signature
                );
            }
            $g->stage = "CoreCommittee";
            $g->lobbyhead_id = Auth::id();
            $g->lobbyhead_signature = $signature;
            $g->lh_text = $request->lh_text;
            $g->save();
        } elseif($g->stage == "President" && Auth::user()->position_id == 1) {
            $request->validate([
                "president_signature" => "nullable|image|min:2|max:2000"
            ]);
            $signature = null;
            if($request->hasFile('president_signature')) {
                $extn = $request->file('president_signature')->getClientOriginalExtension();
                $signature = md5(str_random(20).time()) . '.' .$extn;
                $request->file('president_signature')->storeAs(
                    'signature', $signature
                );
            }
            $g->stage = "Solved";
            $g->president_id = Auth::id();
            $g->president_signature = $signature;
            $g->save();
        } elseif($g->stage == "CoreCommittee" && Auth::user()->position_id < 11 && Auth::user()->position_id > 1) {
            $request->validate([
                "cc_text" => "required|string|min:50|max:2000",
            ]);
            $g->stage = "President";
            $g->corecommittee_id = Auth::id();
            $g->cc_text = $request->cc_text;
            $g->save();
        }
        return redirect()->route('Grievance');
    }
}