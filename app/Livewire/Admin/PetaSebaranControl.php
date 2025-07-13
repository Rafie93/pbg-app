<?php

namespace App\Livewire\Admin;

use App\Models\PenerbitanImb;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PetaSebaranControl extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $reklame = Reklame::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $pbg = Permohonanimb::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $markers = [];
        foreach ($reklame as $key => $value) {
          $terbit = PenerbitanImb::where('permohonan_id',$value->id)->where('jenis','Reklame')->first();
          $markers[] = [
            'lat' => $value->latitude,
            'lng' => $value->longitude,
            'title' => $value->jenis_reklame.' ('.$value->pemohon->nama.')',
            'status' => $terbit ? 'Berizin' : 'Belum Berizin',
          ];
        }
        foreach ($pbg as $key => $value) {
            $terbit = PenerbitanImb::where('permohonan_id',$value->id)->where('jenis','PBG')->first();
            $markers[] = [
              'lat' => $value->latitude,
              'lng' => $value->longitude,
              'title' => $value->fungsiBangunan->nama.' ('.$value->pemohon->nama.')',
              'status' => $terbit ? 'Berizin' : 'Belum Berizin',
            ];
          }
        // dd($markers);
        return view('livewire.admin.peta-sebaran-control',compact('markers'));
    }
}
