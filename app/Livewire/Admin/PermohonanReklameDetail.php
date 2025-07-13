<?php

namespace App\Livewire\Admin;

use App\Models\Reklame;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PermohonanReklameDetail extends Component
{
    use LivewireAlert;

    public $permohonan_id,$tab_selected="deskripsi";
    public function mount($id){
        $this->permohonan_id = $id;
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $data = Reklame::find($this->permohonan_id);

        return view('livewire.admin.permohonan-reklame-detail',compact('data'));
    }

    public function selecttab($id){
        $this->tab_selected = $id;
    }

    public function terima(){
        Reklame::find($this->permohonan_id)->update(['status_permohonan'=>'Diproses']);
        $this->alert('success', 'Permohonan Reklame berhasil diprores');
    }
    public function tolak(){
        Reklame::find($this->permohonan_id)->update(['status_permohonan'=>'Ditolak']);
        $this->alert('success', 'Permohonan Reklame berhasil ditolak');
    }
}
