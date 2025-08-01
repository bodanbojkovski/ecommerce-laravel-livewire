<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Password;

#[Title('Forgot Password')]
class ForgotPasswordPage extends Component
{
    public $email;

    public function save(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Logic to handle the password reset request
        // For example, sending a reset link to the provided email address
        // This part is not implemented here, but you can add your logic
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', 'Password reset link sent to your email.');
            $this->email = ''; // Clear the email input after successful submission
        } else {
            session()->flash('error', 'Failed to send password reset link. Please try again.');
        }

    }
    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
