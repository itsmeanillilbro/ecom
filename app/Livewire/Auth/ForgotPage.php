<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPage extends Component
{
    #[Title('Forget Password - Prakriti Store')]

    public $email;
public function save(){
    $this->validate([
        'email'=>'email|required|exists:users,email|max:255',
    ]);

    $status= Password::sendResetLink(['email'=>$this->email]);
    if($status===Password::RESET_LINK_SENT){
        session()->flash('success','Password reset link has been sent to your email!');
    }
}
    public function render()
    {
        return view('livewire.auth.forgot-page');
    }
}
