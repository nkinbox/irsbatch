<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function HelpList() {
        return view('Member.HelpList');
    }
    public function getHelpForm() {
        return view('Member.Help');
    }
    public function getHelp(Request $request) {
        return $request;
    }
}
