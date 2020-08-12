<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class KaryawanController extends Controller
{
    // DASHBOARD CONTROLLER
    public function index()
    {
        return view('karyawan.karyawan');
    }
}
