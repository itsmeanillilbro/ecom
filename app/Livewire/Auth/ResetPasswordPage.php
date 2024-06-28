<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResetPasswordPage extends Component
{
    use LivewireAlert;

    #[Title('Reset Password - Prakriti Store')]
    public $password;
    public $password_confirmation;
    public $token;
    #[Url]
    public $email;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|max:255|confirmed',
        ]);

        $user = User::where('email', $this->email)->first();
        if (!$user) {
            $this->alert('error', 'User not found.', [
                'position' => 'top-end',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);
            return;
        }


        if (Hash::check($this->password, $user->password)) {
            $this->alert('error', 'The new password cannot be the same as the old password.', [
                'position' => 'top-end',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);
            return;
        }

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('passwordsuccess', 'Password reset successfully');
            return redirect('/login');
        } else {
            $this->alert('error', 'Something went wrong!!!', [
                'position' => 'top-end',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
