<?php

namespace App\Livewire;

use App\Models\Retribusi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RetribusiPemohon extends Component
{
    public function render()
    {
        $retribusi = Retribusi::whereHas(
            'permohonan',
            function ($query) {
                $query->where('pemohon_id', Auth::user()->pemohon()->id);
            }
        )->paginate(10);
        
        return view('livewire.retribusi-pemohon', ['retribusi' => $retribusi]);
    }
}
