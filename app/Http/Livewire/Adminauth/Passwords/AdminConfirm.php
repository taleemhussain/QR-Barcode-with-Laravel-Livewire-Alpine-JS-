<?php

namespace App\Http\Livewire\Adminauth\Passwords;

use Livewire\Component;

class AdminConfirm extends Component
{
    /** @var string */
    public $password = '';

    public function confirm()
    {
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm')->extends('layouts.auth');
    }
}
