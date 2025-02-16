<?php

namespace App\Livewire\Admin;

use App\Models\PenerbitanImb;
use App\Models\Permohonanimb;
use App\Models\Survie;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class PenerbitanImbCreate extends Component
{
    use WithPagination,LivewireAlert;
    
    public $penerbitan_id,$nomor_imb,$permohonanimb_id,$tanggal_penerbitan,$permohonans ,
    $penanda_tangan,$jabatan_penanda_tangan,$nip_penanda_tangan,$option_permohonan=[];

    public $alamat,$fungsi_bangunan,$jenis_bangunan,$kecamatan_id,$kelurahan_id;
    public function mount($id=null){
        $this->tanggal_penerbitan = date('Y-m-d');
    
        if ($id) {
            $this->option_permohonan = Permohonanimb::whereIn('id',Survie::whereNotNull('foto_survie')
                                    ->pluck('id'))
                                    ->get();
            $penerbitan = PenerbitanImb::find($id);
            $this->penerbitan_id = $penerbitan->id;
            $this->nomor_imb = $penerbitan->nomor_imb;
            $this->permohonanimb_id = $penerbitan->permohonanimb_id;
            $this->tanggal_penerbitan = $penerbitan->tanggal_penerbitan;
            $this->penanda_tangan = $penerbitan->penanda_tangan;
            $this->jabatan_penanda_tangan = $penerbitan->jabatan_penanda_tangan;
            $this->nip_penanda_tangan = $penerbitan->nip_penanda_tangan;
            $this->getPermohonan();
        }else{
            $this->option_permohonan = Permohonanimb::whereIn('status_permohonan',
            ['Diproses'])
            ->whereIn('id',Survie::whereNotNull('foto_survie')
            ->pluck('id'))
            ->get();
        }
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.penerbitan-imb-create');
    }

    public function getPermohonan(){
        $this->permohonans = Permohonanimb::where('id',$this->permohonanimb_id)->first();
        $this->alamat = $this->permohonans->alamat;
      
        $this->fungsi_bangunan = $this->permohonans->fungsi_bangunan;
        $this->jenis_bangunan = $this->permohonans->jenis_bangunan;
        $this->kecamatan_id = $this->permohonans->kecamatan_id;
        $this->kelurahan_id = $this->permohonans->kelurahan_id;
        
    }

    public function store(){
        $this->validate([
            'permohonanimb_id' => 'required|unique:penerbitan_imb,permohonanimb_id,'.$this->penerbitan_id,
            'tanggal_penerbitan' => 'required',
            'penanda_tangan' => 'required',
            'jabatan_penanda_tangan' => 'required',
            'nip_penanda_tangan' => 'required',
        ]);
        if($this->nomor_imb == null){
            $last_nomor = PenerbitanImb::whereYear('tanggal_penerbitan',date('Y'))
                        ->orderBy('created_at','desc')
                        ->first();
            if($last_nomor){
                $last_nomor = explode('/',$last_nomor->nomor_imb);
                $nomornya = $last_nomor[0]+1;
                $nomornya = str_pad($nomornya, 4, '0', STR_PAD_LEFT);
                // buat nomornya 4 digit string
                $this->nomor_imb = $nomornya.'/PBG/'.date('Y');
            }
            else{
                $this->nomor_imb = '0001/IMB/'.date('Y');
            }
        }
        $save = PenerbitanImb::updateOrCreate(['id'=>$this->penerbitan_id],[
            'nomor_imb' => $this->nomor_imb,
            'permohonanimb_id' => $this->permohonanimb_id,
            'tanggal_penerbitan' => $this->tanggal_penerbitan,
            'penanda_tangan' => $this->penanda_tangan,
            'jabatan_penanda_tangan' => $this->jabatan_penanda_tangan,
            'nip_penanda_tangan' => $this->nip_penanda_tangan,
        ]);
        if($save){
            // update permoohonan
            $permohonan = Permohonanimb::find($this->permohonanimb_id);
            $permohonan->status_permohonan = 'PBG Diterbitkan';
            $permohonan->save();

            $this->alert('success','Data berhasil disimpan');
            return redirect()->route('penerbitan.list');
        }
        $this->alert('error','Data gagal disimpan');
    }
}
