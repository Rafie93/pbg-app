<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Retribusi;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Http\Request;

class LaporanRetribusi extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.laporan.laporan-retribusi');
    }
    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $status = $req['status'];
        $data = Retribusi::when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_tagihan', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_tagihan', '<=', $enddate);
        })->when($status, function ($query) use ($status) {
            return $query->where('status_pembayaran', $status);
        })->get();

        return view('livewire.admin.laporan.pdf.pdf-retribusi', compact('data', 'startdate', 'enddate', 'status'));
        
    }
}
