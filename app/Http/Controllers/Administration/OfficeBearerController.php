<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeBearerController extends Controller
{
    public function index() {
        return view('Administration.OfficeBearerList');
    }
}
