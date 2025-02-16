<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Survie;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\Layout;

class LaporanSurvie extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.laporan.laporan-survie');
    }
    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $data = Survie::when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_berangkat', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_berangkat', '<=', $enddate);
        })
        ->whereNotNull('foto_survie')
        ->get();

        return view('livewire.admin.laporan.pdf.pdf-survie', compact('data', 'startdate', 'enddate'));
        
    }
}
