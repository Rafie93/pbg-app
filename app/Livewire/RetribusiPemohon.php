<?php

namespace App\Livewire;

use App\Models\Retribusi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RetribusiPemohon extends Component
{
    public function render()
    {
        $retribusi = Retribusi::latest()
                    ->whereHas(
                        'permohonan',
                        function ($query) {
                            $query->where('pemohon_id', Auth::user()->pemohon()->id);
                        }
                    )
                    ->paginate(10);
        $retribusireklame = Retribusi::latest()
                    ->whereHas(
                        'permohonanreklame',
                        function ($query) {
                            $query->where('pemohon_id', Auth::user()->pemohon()->id);
                        }
                    )
                    ->get();
        return view('livewire.retribusi-pemohon', ['retribusi' => $retribusi,'retribusireklame'=> $retribusireklame]);
    }
}
