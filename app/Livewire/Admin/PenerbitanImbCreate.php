<?php

namespace App\Livewire\Admin;

use App\Models\Penandatangan;
use App\Models\PenerbitanImb;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use App\Models\Survie;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class PenerbitanImbCreate extends Component
{
    use WithPagination,LivewireAlert;
    
    public $penerbitan_id,$nomor_imb,$permohonanimb_id,$tanggal_penerbitan,$permohonans ,$jenis="PBG",$tanggal_kadaluarsa,
    $penanda_tangan,$jabatan_penanda_tangan,$nip_penanda_tangan,$option_permohonan=[],$option_permohonan_reklame = [];

    public $alamat,$fungsi_bangunan,$jenis_bangunan,$kecamatan_id,$kelurahan_id;
    public function mount($id=null){
        $this->tanggal_penerbitan = date('Y-m-d');
    
        if ($id) {
            $penerbitan = PenerbitanImb::find($id);
            $this->jenis = $penerbitan->jenis;
            $this->option_permohonan = Permohonanimb::whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis',$this->jenis)
                                    ->pluck('id'))
                                    ->get();
            $this->option_permohonan_reklame = Reklame::whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis',$this->jenis)
                                    ->pluck('id'))
                                    ->get();
                                    
            $this->penerbitan_id = $penerbitan->id;
            $this->nomor_imb = $penerbitan->nomor;
            $this->permohonanimb_id = $penerbitan->permohonan_id;
            $this->tanggal_penerbitan = $penerbitan->tanggal_penerbitan;
            $this->tanggal_kadaluarsa = $penerbitan->tanggal_kadaluarsa;
            $this->penanda_tangan = $penerbitan->penanda_tangan;
            $this->jabatan_penanda_tangan = $penerbitan->jabatan_penanda_tangan;
            $this->nip_penanda_tangan = $penerbitan->nip_penanda_tangan;
            $this->getPermohonan();
        }else{
            $this->option_permohonan = Permohonanimb::whereIn('status_permohonan',
            ['Diproses'])
                    ->whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis','PBG')
                    ->pluck('permohonan_id'))
                    ->get();
            $this->option_permohonan_reklame = Reklame::whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis','Reklame')
                    ->pluck('permohonan_id'))
                    ->get();
        }
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $penandatangan = Penandatangan::all();
        return view('livewire.admin.penerbitan-imb-create',compact('penandatangan'));
    }
    public function changeValue(){
        $this->option_permohonan = Permohonanimb::whereIn('status_permohonan',
        ['Diproses'])
                ->whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis','PBG')
                ->pluck('permohonan_id'))
                ->get();
        $this->option_permohonan_reklame = Reklame::whereIn('id',Survie::whereNotNull('foto_survie')->where('jenis','Reklame')
                ->pluck('permohonan_id'))
                ->get();
    }

    public function getPermohonan(){
        if ($this->jenis=="PBG") {
            $this->permohonans = Permohonanimb::where('id',$this->permohonanimb_id)->first();
            $this->alamat = $this->permohonans->alamat;
            $this->fungsi_bangunan = $this->permohonans->fungsi_bangunan;
            $this->jenis_bangunan = $this->permohonans->jenis_bangunan;
            $this->kecamatan_id = $this->permohonans->kecamatan_id;
            $this->kelurahan_id = $this->permohonans->kelurahan_id;
        }else{
            $this->permohonans = Reklame::where('id',$this->permohonanimb_id)->first();
            $this->jenis_bangunan = $this->permohonans->jenis_reklame;
            $this->alamat = $this->permohonans->alamat;
            $this->kecamatan_id = $this->permohonans->kecamatan_id;
            $this->kelurahan_id = $this->permohonans->kelurahan_id;
        }
        
    }

    public function store(){
        $this->validate([
            'permohonanimb_id' => 'required',
            'tanggal_penerbitan' => 'required',
            'penanda_tangan' => 'required',
        ]);
        if($this->nomor_imb == null){
            $last_nomor = PenerbitanImb::whereYear('tanggal_penerbitan',date('Y'))
                        ->orderBy('created_at','desc')
                        ->first();
            if($last_nomor){
                $last_nomor = explode('/',$last_nomor->nomor);
                $nomornya = $last_nomor[0]+1;
                $nomornya = str_pad($nomornya, 4, '0', STR_PAD_LEFT);
                // buat nomornya 4 digit string
                $this->nomor_imb = $nomornya.'/'.$this->jenis.'/'.date('Y');
            }
            else{
                $this->nomor_imb = '0001/'.$this->jenis.'/'.date('Y');
            }
        }
        $penanda_tangans = Penandatangan::where('nama',$this->penanda_tangan)->first();
        $this->jabatan_penanda_tangan = $penanda_tangans ? $penanda_tangans->jabatan : '-';
        $this->nip_penanda_tangan = $penanda_tangans ? $penanda_tangans->nip : '-';
        
        $save = PenerbitanImb::updateOrCreate(['id'=>$this->penerbitan_id],[
            'nomor' => $this->nomor_imb,
            'jenis' => $this->jenis,
            'permohonan_id' => $this->permohonanimb_id,
            'tanggal_penerbitan' => $this->tanggal_penerbitan,
            'tanggal_kadaluarsa' => $this->tanggal_kadaluarsa,
            'penanda_tangan' => $this->penanda_tangan,
            'jabatan_penanda_tangan' => $this->jabatan_penanda_tangan,
            'nip_penanda_tangan' => $this->nip_penanda_tangan,
        ]);
        if($save){
            // update permoohonan
            if ($save->jenis=="PBG") {
                $permohonan = Permohonanimb::find($this->permohonanimb_id);
                $permohonan->status_permohonan = 'PBG Diterbitkan';
                $permohonan->save();
            }else{
                $permohonan = Reklame::find($this->permohonanimb_id);
                $permohonan->status_permohonan = 'Reklame Diterbitkan';
                $permohonan->save();
            }
        

            $this->alert('success','Data berhasil disimpan');
            return redirect()->route('penerbitan.list');
        }
        $this->alert('error','Data gagal disimpan');
    }
}
