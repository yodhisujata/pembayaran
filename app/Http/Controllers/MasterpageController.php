<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterpageController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Home',
            'breadcrumbchild' => 'Dashboard',
            'loginuser' => 'User',
            'pageurl' => '',
        );
        return view('pages.dashboard', $data);
    }
}
