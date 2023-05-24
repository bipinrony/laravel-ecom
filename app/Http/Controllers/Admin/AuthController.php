<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // by using request helper
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        // by using facad
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'email' => 'required|email|exists:users,email',
        //         'password' => 'required',
        //     ]
        // );

        // if ($validator->fails()) {
        //     return redirect()->route('admin.login.get')
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {

        // }
    }
}