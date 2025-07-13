<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Survie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

class RekapSurvie extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $option_kecamatan = DB::table('districts')
                        ->select('id','name')
                        ->where('city_id', 6371)
                        ->get();
        return view('livewire.admin.laporan.rekap-survie',compact('option_kecamatan'));
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $kecamatan = $req['kecamatan']; 
        $data = Survie::select('kelurahan_id','villages.name as kelurahan',
            'districts.name as kecamatan',
            DB::raw('count(*) as total_bangunan'),
            DB::raw('sum(is_mangkrak) as total_mangkrak'),
            DB::raw('sum(is_kosong) as total_kosong'),
            DB::raw('sum(is_miring) as total_miring'),
        )
        ->when($startdate, function ($query) use ($startdate) {
            return $query->where('tanggal_berangkat', '>=', $startdate);
        })->when($enddate, function ($query) use ($enddate) {
            return $query->where('tanggal_berangkat', '<=', $enddate);
        })
        ->when($kecamatan, function ($query) use ($kecamatan) {
            return $query->where('kecamatan_id', $kecamatan);
        })
        ->whereNotNull('foto_survie')
        ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        ->leftJoin('villages', 'villages.id', '=', 'survie.kelurahan_id')
        ->leftJoin('districts', 'districts.id', '=', 'villages.district_id')
        ->get();
        
        // $data = Survie::select('kelurahan_id','villages.name as kelurahan',
        //     'districts.name as kecamatan',
        //     DB::raw('count(*) as total_bangunan'),
        //     DB::raw('sum(is_mangkrak) as total_mangkrak'),
        //     DB::raw('sum(is_kosong) as total_kosong'),
        //     DB::raw('sum(is_miring) as total_miring'),
        // )
        // ->when($startdate, function ($query) use ($startdate) {
        //     return $query->where('tanggal_berangkat', '>=', $startdate);
        // })->when($enddate, function ($query) use ($enddate) {
        //     return $query->where('tanggal_berangkat', '<=', $enddate);
        // })
        // ->when($kecamatan, function ($query) use ($kecamatan) {
        //     return $query->where('kecamatan_id', $kecamatan);
        // })
        // ->where('jenis','Reklame')
        // ->whereNotNull('foto_survie')
        // ->groupBy('kelurahan_id', 'villages.name', 'districts.name')
        // ->leftJoin('villages', 'villages.id', '=', 'survie.kelurahan_id')
        // ->leftJoin('districts', 'districts.id', '=', 'villages.district_id')
        // ->unionAll($data_awal)
        // ->get();
        // dd($data);
    
        return view('livewire.admin.laporan.pdf.rekap-pdf-survie', compact('data', 'startdate', 'enddate'));
        
    }
}
