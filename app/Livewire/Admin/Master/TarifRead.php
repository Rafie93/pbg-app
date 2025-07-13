<?php

namespace App\Livewire\Admin\Master;

use App\Models\Tarif;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

class TarifRead extends Component
{
    use LivewireAlert;
    
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $tarifs = Tarif::latest()->where('jenis_permohonan','PBG')->get();
        return view('livewire.admin.master.tarif-read',[
            'tarifs' => $tarifs
        ]);
    }
}
