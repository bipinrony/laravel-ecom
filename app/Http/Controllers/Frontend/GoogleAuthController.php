<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationSuccess;
use App\Models\User;
use App\Notifications\NewRegistration;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_uuid', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->password = Hash::make($user->id);
                $newUser->google_uuid = $user->id;
                if ($newUser->save()) {
                    Auth::login($newUser);
                    Mail::to($user->email)->send(new RegistrationSuccess($newUser));

                    // send notification to admin
                    $admin = User::where('role', User::ADMIN_ROLE)->first();
                    $admin->notify(new NewRegistration($newUser));
                }
                return redirect()->route('home');
            }
        } catch (Exception  $e) {
            dd($e->getMessage());
        }
    }
}
