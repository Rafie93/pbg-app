<?php

namespace App\Livewire;

use App\Models\Permohonanimb;
use App\Models\Retribusi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class RetribusiPemohonBayar extends Component
{
    use WithFileUploads,LivewireAlert;
    public $retribusis,$tanggal_bayar,$bukti_pembayaran;

    public function mount($id){
        $permohonan = Permohonanimb::where('nomor',$id)->first();
        $this->tanggal_bayar = date('Y-m-d');
        if(!$permohonan){
            return redirect()->route('retribusi.pemohon');
        }
        $this->retribusis = Retribusi::where('permohonanimb_id',$permohonan->id)->first();
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
        // save foto to storage

        $this->alert('success', 'Berhasil membayar retribusi');
        sleep(2);
        return redirect()->route('retribusi.pemohon');
    }
}
