<?php

namespace App\Livewire\Admin;

use App\Models\Permohonanimb;
use App\Models\Retribusi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;

class RetribusiCreate extends Component
{
    use LivewireAlert;
    public $retribusi_id, $option_permohonan=[],$permohonans;
    public $permohonanimb_id,$tanggal_tagihan,$tanggal_bayar=null,$jumlah_tagihan,$jumlah_bayar=0,$status_pembayaran='Belum Dibayar',$keterangan;
    
    public function mount($id=null){
        $this->tanggal_tagihan = date('Y-m-d');
        $this->option_permohonan = Permohonanimb::whereIn('status_permohonan',
                                        ['Diproses'])
                                        ->whereNotIn('id',Retribusi::pluck('permohonanimb_id'))
                                        ->get();
        if($id){
          
        }

    }

    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        return view('livewire.admin.retribusi-create');
    }

    public function getPermohonan(){
        $this->permohonans = Permohonanimb::where('id',$this->permohonanimb_id)->first();
    }

    public function store(){
        $this->validate([
            'permohonanimb_id'=> 'required|unique:retribusi,permohonanimb_id',
            'tanggal_tagihan'=>'required',
            'jumlah_tagihan' => 'required|numeric',
        ]);
        $save = Retribusi::updateOrCreate([
            'id' => $this->retribusi_id
        ],[
            'permohonanimb_id' => $this->permohonanimb_id,
            'tanggal_tagihan' => $this->tanggal_tagihan,
            'tanggal_bayar'=> $this->tanggal_bayar,
            'jumlah_tagihan' => $this->jumlah_tagihan,
            'jumlah_bayar' => $this->jumlah_bayar,
            'keterangan' => $this->keterangan,
            'status_pembayaran' => $this->status_pembayaran,
        ]);
        $this->alert('success','Data Berhasil disimpan');
        sleep(2);
        return redirect()->route('retribusi.list')->with('success','Data Berhasil disimpan');
    }
}
