<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\RegistrationSuccess;
use App\Models\User;
use App\Notifications\NewRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        // send success mail
        Mail::to($user->email)->send(new RegistrationSuccess($user));

        // send notification to admin
        $admin = User::where('role', User::ADMIN_ROLE)->first();
        $admin->notify(new NewRegistration($user));
    }
}
