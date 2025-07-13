<?php

namespace App\Livewire\Admin\Master;

use App\Models\Partnership;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class PetugasCreate extends Component
{
    use LivewireAlert;

   public $petugas_id,$name,$email,$password,$role,$option_role;

    public function mount($id=null)
    {
        $this->option_role = [
            ['id' => 1, 'name' => 'Super Admin'],
            ['id' => 2, 'name' => 'Admin'],
            ['id' => 3, 'name' => 'Pemohon'],
            ['id' => 4, 'name' => 'Petugas'],
            ['id' => 5, 'name' => 'Pimpinan'],
        ];
        if($id) {
            $this->petugas_id = $id;
            $petugas = User::find($id);
            $this->name = $petugas->name;
            $this->email = $petugas->email;
            $this->role = $petugas->role; 
        }
    }
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        return view('livewire.admin.master.petugas-create');
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->petugas_id,
            'role' => 'required',
        ]);

        if($this->petugas_id){
            $petugas = User::find($this->petugas_id);
            $petugas->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
        }else{
            $this->validate([
                'password' => 'required',
            ]);
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => $this->role,
            ]);
        }
        $this->alert('success','Data berhasil disimpan');
        return redirect()->route('master.petugas');

      
    }
}
