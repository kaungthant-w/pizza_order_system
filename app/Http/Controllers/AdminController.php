<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function details() {
        return view('admin.account.details');
    }
}
