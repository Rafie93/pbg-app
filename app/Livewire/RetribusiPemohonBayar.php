<?php

namespace App\Livewire;

use App\Models\Permohonanimb;
use App\Models\Reklame;
use App\Models\Retribusi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class RetribusiPemohonBayar extends Component
{
    use WithFileUploads,LivewireAlert;
    public $retribusis,$tanggal_bayar,$bukti_pembayaran,$jenis_permohonan;

    public function mount($id,$jenis='pbg'){
        $this->tanggal_bayar = date('Y-m-d');
        $this->jenis_permohonan = $jenis;
        if ($jenis=='reklame') {
            $permohonan = Reklame::where('nomor',$id)->first();
            $this->retribusis = Retribusi::where('permohonan_id',$permohonan->id)
                                    ->where('jenis','Reklame')
                                    ->first();
        }else{
            $permohonan = Permohonanimb::where('nomor',$id)->first();
            // if(!$permohonan){
            //     return redirect()->route('retribusi.pemohon');
            // }
            $this->retribusis = Retribusi::where('permohonan_id',$permohonan->id)->where('jenis','PBG')->first();
        }
       
    }
    public function render()
    {
        return view('livewire.retribusi-pemohon-bayar');
    }

    public function store(){
        $this->validate([
            'tanggal_bayar' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->retribusis->update([
            'tanggal_bayar' => $this->tanggal_bayar,
            'bukti_pembayaran' => $this->bukti_pembayaran->store('bukti_pembayaran','public'),
            'status_pembayaran' => 'Dibayar'
        ]);
        // update permohonan
        Permohonanimb::where('id',$this->retribusis->permohonanimb_id)->update([
            'status_permohonan' => 'Diproses'
        ]);

        $this->alert('success', 'Berhasil membayar retribusi');
        sleep(2);
        return redirect()->route('retribusi.pemohon');
    }
}
