<?php

namespace App\Livewire\Admin;

use App\Models\News;
use App\Models\Permohonanimb;
use App\Models\Retribusi;
use App\Models\Survie;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class SurvieListCreate extends Component
{
    use WithFileUploads, LivewireAlert;
    public $option_permohonan = [],$permohonans,$option_petugas = [],$role,$label ;
    public $survie_id,$permohonanimb_id,$petugas_id,$tanggal_berangkat,$kecamatan_id,$kelurahan_id,
    $alamat,$latitude,$longitude,$fungsi_bangunan,$jenis_bangunan,$keterangan,$is_mangkrak,
    $is_kosong,$is_miring,$foto_survie;
    
    public function mount($id=null){
        $this->role = auth()->user()->role;
        if($this->role == 1 || $this->role == 2){
            $this->label = "Penugasan";
        }else if($this->role ==4){
            $this->label = "Pemeriksaan";
            $this->petugas_id = auth()->user()->id;
        }
        $this->option_petugas = User::where('role',4)->get();
        
        if($id){
            $this->option_permohonan = Permohonanimb::whereIn('id',Retribusi::where('status_pembayaran','Pembayaran Diterima')
                                        ->pluck('permohonanimb_id'))
                                        ->get();
            $this->survie_id=$id;
            $e = Survie::find($id);
            $this->permohonanimb_id = $e->permohonanimb_id;
            $this->petugas_id = $e->petugas_id;
            $this->tanggal_berangkat = $e->tanggal_berangkat;
            $this->kecamatan_id = $e->kecamatan_id;
            $this->kelurahan_id = $e->kelurahan_id;
            $this->alamat = $e->alamat;
            $this->latitude = $e->latitude;
            $this->longitude = $e->longitude;
            $this->fungsi_bangunan = $e->fungsi_bangunan;
            $this->jenis_bangunan = $e->jenis_bangunan;
            $this->keterangan = $e->keterangan;
            $this->is_mangkrak = $e->is_mangkrak;
            $this->is_kosong = $e->is_kosong;
            $this->is_miring = $e->is_miring;
            $this->foto_survie = $e->foto_survie;
            $this->getPermohonan();
        }else{
            $this->option_permohonan = Permohonanimb::whereIn('status_permohonan',
                                ['Diproses'])
                                ->whereIn('id',Retribusi::where('status_pembayaran','Pembayaran Diterima')
                                ->pluck('permohonanimb_id'))
                                ->get();
        }
    }
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.survie-list-create');
    }

    public function getPermohonan(){
        $this->permohonans = Permohonanimb::where('id',$this->permohonanimb_id)->first();
        $this->alamat = $this->permohonans->alamat;
        $this->latitude = $this->permohonans->latitude;
        $this->longitude = $this->permohonans->longitude;
        $this->fungsi_bangunan = $this->permohonans->fungsi_bangunan;
        $this->jenis_bangunan = $this->permohonans->jenis_bangunan;
        $this->kecamatan_id = $this->permohonans->kecamatan_id;
        $this->kelurahan_id = $this->permohonans->kelurahan_id;
        
    }
    

    public function store(){
        $this->validate([
            'petugas_id'=> 'required',
            'tanggal_berangkat'=>'required',
            'permohonanimb_id' => 'required',
        ]);
        if($this->role == 4){
            $this->petugas_id = auth()->user()->id;
            $this->validate([
                'foto_survie' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }
        $save = Survie::updateOrCreate([
            'id' => $this->survie_id
        ],[
            'permohonanimb_id' => $this->permohonanimb_id,
            'petugas_id' => $this->petugas_id,
            'tanggal_berangkat' => $this->tanggal_berangkat,
            'kecamatan_id' => $this->kecamatan_id,
            'kelurahan_id' => $this->kelurahan_id,
            'alamat' => $this->alamat,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'fungsi_bangunan' => $this->fungsi_bangunan,
            'jenis_bangunan' => $this->jenis_bangunan,
            'keterangan' => $this->keterangan,
            'is_mangkrak' => $this->is_mangkrak,
            'is_kosong' => $this->is_kosong,
            'is_miring' => $this->is_miring,
        ]);
        if ($this->foto_survie) {
            $this->foto_survie->storeAs('survie', $save->id . '.' . $this->foto_survie->extension(), 'public');
            $save->foto_survie = 'survie/' . $save->id . '.' . $this->foto_survie->extension();
            $save->save();
        }

        return redirect()->route('survie.list')->with('success','Data Berhasil disimpan');

    }
}
