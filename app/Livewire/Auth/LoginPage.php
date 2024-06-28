<?php

namespace App\Livewire\Auth;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginPage extends Component
{

    use LivewireAlert;
    #[Title('Login - Prakriti Store')]

    public $email;
    public $password;



    public function mount()
    {
        if (session()->has('passwordsuccess')) {
            $this->alert('success', session('passwordsuccess'), [
                'position' => 'top-end',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);
        }
    }
    public function save(){

        $this->validate([
            'email'=> 'required|email|max:255|exists:users,email',
            'password'=> 'required|min:6|max:255'
        ]);

        if(!auth()->attempt(['email'=>$this->email,'password'=>$this->password])){
            $this->alert('error', 'Invalid Credentials', [
                'position' => 'top-end',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);

            return;


        }
        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
