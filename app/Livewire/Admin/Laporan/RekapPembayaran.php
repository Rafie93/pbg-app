<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Retribusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

class RekapPembayaran extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.laporan.rekap-pembayaran');
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $data = Retribusi::select('kelurahan_id','villages.name as kelurahan',
            'districts.name as kecamatan',
            DB::raw('count(*) as total_bangunan'),
            DB::raw('sum(jumlah_tagihan) as total_retribusi'),
            DB::raw('sum(jumlah_bayar) as total_retribusi_bayar'),

        )
        ->when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_tagihan', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_tagihan', '<=', $enddate);
        })       
        ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        ->leftJoin('permohonanimb', 'permohonanimb.id', '=', 'retribusi.permohonanimb_id')
        ->leftJoin('villages', 'villages.id', '=', 'permohonanimb.kelurahan_id')
        ->leftJoin('districts', 'districts.id', '=', 'villages.district_id')
        ->get();

        // dd($data);
        return view('livewire.admin.laporan.pdf.rekap-pdf-pembayaran', compact('data', 'startdate', 'enddate'));
        
    }
}
