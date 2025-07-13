<?php

namespace App\Livewire\Admin\Master;

use App\Models\Tarif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TarifReklameRead extends Component
{
    use LivewireAlert;
    
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        $tarifs = Tarif::latest()->where('jenis_permohonan','Reklame')->get();
        return view('livewire.admin.master.tarif-reklame-read',compact('tarifs'));
    }

    public function delete($id){
        $tarif = Tarif::find($id);
        $tarif->delete();
        $this->alert('success', 'Data berhasil dihapus');
    }
}
