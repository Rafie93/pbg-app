<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginControl extends Component
{
    use LivewireAlert;

    public $email, $password;
    public function render()
    {
        return view('livewire.login-control');
    }

    public function store(){
        $this->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);
        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::Attempt($data)) {
            $this->alert('success','Berhasil Login');
            return redirect()->route('home');
        }else{
            $this->alert('error','Email / Password Salah');
        }

    }

    public function logout(){
        Auth::Logout();
        $this->alert('success','logout berhasil');
        return redirect()->route('home');
    }
}
