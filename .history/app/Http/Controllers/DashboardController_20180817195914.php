<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function versionone()
    {
        return view('home');
    }
    public function versiontwo()
    {
        return view('v2');
    }
    public function versionthree()
    {
        return view('home');
    }
}
