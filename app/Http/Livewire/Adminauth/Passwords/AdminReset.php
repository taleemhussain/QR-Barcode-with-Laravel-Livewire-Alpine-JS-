<?php

namespace App\Http\Livewire\Adminauth\Passwords;

use App\Providers\RouteServiceProvider;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AdminReset extends Component
{
    /** @var string */
    public $token;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordConfirmation;

    public function mount($token)
    {
        $this->email = request()->query('email', '');
        $this->token = $token;
    }

    public function resetPassword()
    {

        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|same:passwordConfirmation',
        ]);

        $response = $this->broker('admins')->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);

                $user->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
                Auth::guard('admin')->login($user, true);
                //$this->guard('admin')->login($user);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            session()->flash(trans($response));

            return redirect(route('admin.dashboard'));
        }

        $this->addError('email', trans($response));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker($admins)
    {
        return Password::broker($admins);
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function render()
    {
        return view('livewire.auth.passwords.reset')->extends('layouts.auth');
    }
}
