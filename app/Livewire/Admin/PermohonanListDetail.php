<?php

namespace App\Livewire\Admin;

use App\Models\Komunitas;
use App\Models\Permohonanimb;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PermohonanListDetail extends Component
{
    use LivewireAlert;

    public $permohonan_id,$tab_selected="deskripsi";
    public function mount($id){
        $this->permohonan_id = $id;
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {      
        $data = Permohonanimb::find($this->permohonan_id);

        return view('livewire.admin.permohonan-list-detail',compact('data'));
    }

    
    public function selecttab($id){
        $this->tab_selected = $id;
    }

    public function terima(){
        Permohonanimb::find($this->permohonan_id)->update(['status_permohonan'=>'Diproses']);
        $this->alert('success', 'Permohonan IMB berhasil diprores');
    }
    public function tolak(){
        Permohonanimb::find($this->permohonan_id)->update(['status_permohonan'=>'Ditolak']);
        $this->alert('success', 'Permohonan IMB berhasil ditolak');
    }
}
