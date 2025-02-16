<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\PenerbitanImb;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;

use Livewire\Component;

class LaporanPenerbitanImb extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.laporan.laporan-penerbitan-imb');
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $data = PenerbitanImb::when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_penerbitan', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_penerbitan', '<=', $enddate);
        })
        ->get();

        return view('livewire.admin.laporan.pdf.pdf-penerbitan', compact('data', 'startdate', 'enddate'));
        
    }
}
