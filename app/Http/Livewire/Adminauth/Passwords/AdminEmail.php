<?php

namespace App\Http\Livewire\Adminauth\Passwords;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class AdminEmail extends Component
{
    /** @var string */
    public $email;

    /** @var string|null */
    public $emailSentMessage = false;

    public function sendResetPasswordLink()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $response = $this->broker('admins')->sendResetLink(['email' => $this->email]);

        if ($response == Password::RESET_LINK_SENT) {
            $this->emailSentMessage = trans($response);

            return;
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
        //dd(Password::broker($admins));
        return Password::broker($admins);
    }

    public function render()
    {
        return view('livewire.auth.passwords.email')->extends('layouts.auth');
    }
}
