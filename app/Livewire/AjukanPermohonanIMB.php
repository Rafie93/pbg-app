<?php

namespace App\Livewire;

use App\Models\FungsiBangunan;
use App\Models\JenisBangunan;
use App\Models\Permohonanimb;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class AjukanPermohonanIMB extends Component
{
    use WithFileUploads;
    public $pemohons;
    public $nomor, $tanggal_permohonan,$pemohon_id,$jenis_permohonan,$pemilik_bangunan,
    $kecamatan_id,$kelurahan_id,$alamat,$latitude,$longitude,$fungsi_bangunan,$luas_bangunan,
    $jumlah_lantai,$tinggi_bangunan,$jenis_bangunan,$kondisi_bangunan,$durasi_pemanfaatan,
    $status_permohonan,$foto_bangunan,$keterangan,$nama_bangunan,$city_id=6371;

    public $option_district = [], $option_village = [], $option_fungsi_bangunan = [], $option_jenis_bangunan = [],
     $option_kondisi_bangunan = [], $option_durasi_pemanfaatan = [],$option_city = [];

    public function mount(){
        $auth = auth()->user();
        $this->pemohons = $auth->pemohon();
        $this->pemohon_id = $this->pemohons->id;
        $this->tanggal_permohonan = date('Y-m-d');
        $this->status_permohonan = "Pengajuan";
        $this->option_jenis_bangunan = JenisBangunan::where('status','Aktif')->get();
        $this->option_fungsi_bangunan = FungsiBangunan::where('status','Aktif')->get();
        $this->option_city = DB::table("citys")->where("state_id",63)->get();
        $this->kecamatan_id = $this->pemohons->kecamatan_id;
        $this->kelurahan_id = $this->pemohons->kelurahan_id;
        $this->nomor = date('y').date('m').date('d').'-'.rand(100,999);
        $this->getDistrict();
        $this->getVillage();

        // dd($this->pemohons);
    }
    public function render()
    {
        return view('livewire.ajukan-permohonan-i-m-b');
    }

    public function getDistrict(){
        if($this->city_id){
            $this->option_district = DB::table("districts")->where("city_id",$this->city_id)->get();
        }
    }
    public function getVillage(){
        if($this->kecamatan_id){
            $this->option_village = DB::table("villages")->where("district_id",$this->kecamatan_id)->get();
        }
    }

    public function store(){
        $this->validate([
            'pemilik_bangunan' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_lantai' => 'required',
            'tinggi_bangunan' => 'required',
            'jenis_bangunan' => 'required',
            'kondisi_bangunan' => 'required',
            'durasi_pemanfaatan' => 'required',
            'foto_bangunan' => 'required|image|max:5024',
        ]);

        Permohonanimb::create([
            "nomor" => $this->nomor,
            "tanggal_permohonan" => $this->tanggal_permohonan,
            "pemohon_id" => $this->pemohon_id,
            "jenis_permohonan" => $this->jenis_permohonan ? $this->jenis_permohonan : "IMB",
            "pemilik_bangunan" => $this->pemilik_bangunan,
            "kecamatan_id" => $this->kecamatan_id,
            "kelurahan_id" => $this->kelurahan_id,
            "alamat" => $this->alamat,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "nama_bangunan" => $this->nama_bangunan,
            "fungsi_bangunan" => $this->fungsi_bangunan,
            "luas_bangunan" => $this->luas_bangunan,
            "jumlah_lantai" => $this->jumlah_lantai,
            "tinggi_bangunan" => $this->tinggi_bangunan,
            "jenis_bangunan" => $this->jenis_bangunan,
            "kondisi_bangunan" => $this->kondisi_bangunan,
            "durasi_pemanfaatan" => $this->durasi_pemanfaatan,
            "status_permohonan" => $this->status_permohonan,
            "foto_bangunan" => $this->foto_bangunan->store('foto_bangunan','public'),
            "keterangan" => $this->keterangan,
        ]);
        return redirect()->route('home');
    }

}
