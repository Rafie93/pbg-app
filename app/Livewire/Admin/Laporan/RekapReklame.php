<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Reklame;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;

class RekapReklame extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $option_kecamatan = DB::table('districts')
                    ->select('id','name')
                    ->where('city_id', 6371)
                    ->get();
        return view('livewire.admin.laporan.rekap-reklame',compact('option_kecamatan'));
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $kecamatan = $req['kecamatan']; 
        $data = Reklame::select('kelurahan_id','villages.name as kelurahan',
            'districts.name as kecamatan',
            DB::raw('count(*) as total_bangunan'),
        )
        ->when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_permohonan', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_permohonan', '<=', $enddate);
        })
        ->when($kecamatan, function ($query) use ($kecamatan) {
            return $query->where('kecamatan_id', $kecamatan);
        })
        ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        ->leftJoin('villages', 'villages.id', '=', 'reklame.kelurahan_id')
        ->leftJoin('districts', 'districts.id', '=', 'villages.district_id')
        ->get();
        
        return view('livewire.admin.laporan.pdf.rekap-pdf-reklame', compact('data', 'startdate', 'enddate'));
        
    }
}
