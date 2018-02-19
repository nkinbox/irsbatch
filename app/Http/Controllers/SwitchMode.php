<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwitchMode extends Controller
{
    public function index($mode) {
        session(["mode" => $mode]);
        return redirect()->back();
    }
}
