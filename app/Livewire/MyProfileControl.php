<?php

namespace App\Livewire;

use App\Models\Pemohon;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MyProfileControl extends Component
{
    use LivewireAlert;
    public $name, $email, $password,$user_id,$phone;
    public function mount(){
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_id = $user->id;
        
        Pemohon::where('user_id',$user->id)->first() ? $this->phone = Pemohon::where('user_id',$user->id)->first()->no_hp : $this->phone = '';
    }
    public function render()
    {
        return view('livewire.my-profile-control');
    }

    public function update(){
        $this->validate([
            'name'=> 'required',
            'email'=> 'required'
        ]);
        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if($this->password){
            $user->password = bcrypt($this->password);
        }
        $user->save();
        $this->alert('success','Akun Berhasil diperbaharui');
        return redirect()->route('profile');
    }
}
