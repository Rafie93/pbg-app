<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Reklame;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;

class LaporanReklame extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.laporan.laporan-reklame');
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $status = $req['status'];
        $data = Reklame::when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_permohonan', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_permohonan', '<=', $enddate);
        })->when($status, function ($query) use ($status) {
            return $query->where('status_permohonan', $status);
        })->get();

        return view('livewire.admin.laporan.pdf.pdf-reklame', compact('data', 'startdate', 'enddate', 'status'));
        
    }
}
