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
        $data_awal = Retribusi::select('kelurahan_id','villages.name as kelurahan',
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
        ->where('jenis','PBG')       
        ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        ->leftJoin('permohonan', 'permohonan.id', '=', 'retribusi.permohonan_id')
        ->leftJoin('villages', 'villages.id', '=', 'permohonan.kelurahan_id')
        ->leftJoin('districts', 'districts.id', '=', 'villages.district_id');

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
        // ->where('jenis','Reklame')       
        ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        ->leftJoin('permohonan', 'permohonan.id', '=', 'retribusi.permohonan_id')
        ->leftJoin('villages', 'villages.id', '=', 'permohonan.kelurahan_id')
        ->leftJoin('districts', 'districts.id', '=', 'villages.district_id')
        ->get();
        // dd($data);
        return view('livewire.admin.laporan.pdf.rekap-pdf-pembayaran', compact('data', 'startdate', 'enddate'));
        
    }
}
