<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Permohonanimb;
use App\Models\Reklame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LaporanPerizinan extends Component
{
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        $option_kecamatan = DB::table('districts')
                    ->select('id','name')
                    ->where('city_id', 6371)
                    ->get();
        return view('livewire.admin.laporan.laporan-perizinan',compact('option_kecamatan'));
    }

    public function pdf(Request $request)
    {
        $req = $request->all();
        $startdate = $req['startdate'];
        $enddate = $req['enddate'];
        $kecamatan = $req['kecamatan']; 
        $kec = DB::table('villages')
                    ->select('id','name')
                    ->whereIn('district_id', DB::table('districts')->where('city_id',6371)->pluck('id'))
                    ->get();
        $data = [];
        // dd($kec);
        foreach ($kec as $key => $value) {
           $total_reklame = Reklame::where('kelurahan_id',$value->id)->count();
           $total_bangunan = Permohonanimb::where('kelurahan_id',$value->id)->count();
           $total = $total_bangunan + $total_reklame;
           if ($total==0 ) {
                // break;
           }else{
            $data[$key] = [
                'id' => $value->id,
                'kelurahan' => $value->name,
                'total_reklame' => $total_reklame,
                'total_bangunan' => $total_bangunan,
                'total' => $total,
            ];
           }
        }
        // dd($data);
        return view('livewire.admin.laporan.pdf.pdf-perizinan', compact('data', 'startdate', 'enddate'));
        
    }
}
