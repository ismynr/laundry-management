<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // DASHBOARD CONTROLLER
    public function index()
    {
        return view('admin.admin');
    }
}
