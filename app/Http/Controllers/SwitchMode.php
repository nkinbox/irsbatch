<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SwitchMode extends Controller
{
    public function index($mode) {
        $user = Auth::user();
        switch($mode) {
            case "member":
            $mode = "member";
            break;
            case "lobbyhead":
            if($user->position_id == 1 || $user->position_id == 11)
            $mode = "lobbyhead";
            else
            $mode = "member";
            break;
            case "corecommittee":
            if($user->position_id > 0 && $user->position_id < 11)
            $mode = "corecommittee";
            else
            $mode = "member";
            break;
            case "president":
            if($user->position_id == 1)
            $mode = "president";
            else
            $mode = "member";
            break;
            default:
            $mode = "member";
        }
        session(["mode" => $mode]);
        return redirect()->back();
    }
}
