<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if(Auth::check()){
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    
                case 'karyawan':
                    return redirect()->route('karyawan.dashboard');
            }
        }

        return view('login');
    }
}
