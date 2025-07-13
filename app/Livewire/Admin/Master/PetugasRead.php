<?php

namespace App\Livewire\Admin\Master;

use App\Models\Survie;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PetugasRead extends Component
{
    use LivewireAlert;
    
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        $petugas = User::latest()
                    ->whereIn('role',[1,2,4,5])
                    ->get();
        return view('livewire.admin.master.petugas-read',compact('petugas'));
    }

    public function delete($id){
        $petugas = User::find($id);
        // cek
        $c = Survie::where('user_id',$id);
        if($c->count() > 0){
            $this->alert('error','Data tidak bisa dihapus karena masih terdapat data yang terkait');
            return;
        }
        $petugas->delete();
        $this->alert('success','Data barhasil dihapus');
    }
}
