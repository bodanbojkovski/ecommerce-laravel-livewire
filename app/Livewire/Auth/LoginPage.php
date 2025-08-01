<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Login Page')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function save(){
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6',
        ]);

        // Here you would typically handle the login logic, such as checking credentials
        // and redirecting the user or showing an error message.
        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Invalid credentials. Please try again.');
            return;
        }

        return redirect()->intended();
        
        // session()->flash('message', 'Login successful!'); // Example success message
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
