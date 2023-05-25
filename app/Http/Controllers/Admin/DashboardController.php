<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $title = "dashboard";
        // return view('admin.dashboard', compact("title"));

        $data = array();
        $data['title'] = "Dashboard";
        $data['total_users'] = User::where('role', User::CUSTOMER_ROLE)->count();
        return view('admin.dashboard', $data);
    }
}