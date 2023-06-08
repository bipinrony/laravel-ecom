<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationSuccess;
use App\Models\User;
use App\Notifications\NewRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginView()
    {
        $data = array();
        $data['title'] = "Login";
        return view('frontend.login', $data);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with('success', 'Login successfull');
        } else {
            return redirect()->route('login.get')->with('error', 'Login failed');
        }
    }

    public function registerView()
    {
        // $user = User::find(2);
        // Mail::to($user->email)->send(new RegistrationSuccess($user));

        // // send notification to admin
        // $admin = User::where('role', User::ADMIN_ROLE)->first();
        // $admin->notify(new NewRegistration($user));

        $data = array();
        $data['title'] = "Register";
        return view('frontend.register', $data);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        if ($user->save()) {
            // send success mail
            Mail::to($user->email)->send(new RegistrationSuccess($user));

            // send notification to admin
            $admin = User::where('role', User::ADMIN_ROLE)->first();
            $admin->notify(new NewRegistration($user));


            return redirect()->route('login.get')->with('success', 'registration successful.');
        } else {
            return redirect()->route('register.get')->with('error', 'Something went wrong!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
