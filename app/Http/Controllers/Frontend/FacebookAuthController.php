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
use Nette\InvalidStateException;

class FacebookAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        // try {
        $user = Socialite::driver('facebook')->stateless()->user();

        $finduser = User::where('facebook_uuid', $user->id)->first();
        if ($finduser) {
            Auth::login($finduser);
            return redirect()->route('home');
        } else {
            $newUser = new User();
            $newUser->name = $user->name;
            if ($user->email) {
                $newUser->email = $user->email;
            }
            $newUser->password = Hash::make($user->id);
            $newUser->facebook_uuid = $user->id;
            if ($newUser->save()) {
                Auth::login($newUser);
                if ($user->email) {
                    Mail::to($user->email)->send(new RegistrationSuccess($newUser));
                }

                // send notification to admin
                $admin = User::where('role', User::ADMIN_ROLE)->first();
                $admin->notify(new NewRegistration($newUser));
            }
            return redirect()->route('home');
        }
        // } catch (Exception  $e) {
        //     dd($e->getMessage());
        // }
    }
}
