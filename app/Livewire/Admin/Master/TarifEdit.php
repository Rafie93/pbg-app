<?php

namespace App\Livewire\Admin\Master;

use App\Models\Tarif;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

class TarifEdit extends Component
{
    use LivewireAlert;

    public $tarifs,$tarif,$tarif_id ;
    
    public function mount($id){
        $this->tarif_id = $id;
        $this->tarifs = Tarif::find($id);
        $this->tarif = $this->tarifs->tarif;
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.master.tarif-edit');
    }

    public function store(){
        $this->validate([
            'tarif' => 'required',
        ]);
        $this->tarifs->update([
            'tarif' => $this->tarif
        ]);
        $this->alert('success', 'Data berhasil diupdate');
        return redirect()->route('master.tarif');
    }
}
