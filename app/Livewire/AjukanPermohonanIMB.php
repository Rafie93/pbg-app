<?php

namespace App\Livewire;

use App\Models\FungsiBangunan;
use App\Models\JenisBangunan;
use App\Models\Permohonanimb;
use App\Models\Retribusi;
use App\Models\Tarif;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class AjukanPermohonanIMB extends Component
{
    use WithFileUploads, LivewireAlert;
    public $pemohons,$estimasi_retribusi=0,$tarif_found=false;
    public $nomor, $tanggal_permohonan,$pemohon_id,$jenis_permohonan,$pemilik_bangunan,
    $kecamatan_id,$kelurahan_id,$alamat,$latitude  = '-3.31900629751783561', $longitude = '114.5913495840888',$fungsi_bangunan,$luas_bangunan,
    $jumlah_lantai,$tinggi_bangunan,$jenis_bangunan,$kondisi_bangunan,$durasi_pemanfaatan,
    $status_permohonan,$foto_bangunan,$keterangan,$nama_bangunan,$city_id=6371;

    public $option_district = [], $option_village = [], $option_fungsi_bangunan = [], $option_jenis_bangunan = [],
     $option_kondisi_bangunan = [], $option_durasi_pemanfaatan = [],$option_city = [];

 

    public function mount(){
        $auth = auth()->user();
        $this->pemohons = $auth->pemohon();
        $this->pemohon_id = $this->pemohons->id;
        $this->tanggal_permohonan = date('Y-m-d');
        $this->status_permohonan = "Diajukan";
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

    public function hitungPerkiraan(){
        $this->estimasi_retribusi = 0;
        if($this->fungsi_bangunan && $this->pemilik_bangunan && $this->durasi_pemanfaatan && $this->jumlah_lantai && $this->luas_bangunan){
            $result = Tarif::orderBy('tarif','desc')
                        ->where('jenis_permohonan','PBG')
                        ->where('fungsi_bangunan_id',$this->fungsi_bangunan)
                        ->where('kepemilikan',$this->pemilik_bangunan)
                        ->where('durasi_pemanfaatan',$this->durasi_pemanfaatan)
                        ->where('min_jumlah_lantai','<=',$this->jumlah_lantai)
                        ->where('max_jumlah_lantai','>=',$this->jumlah_lantai)
                        ->where('min_luas_bangunan','<=',$this->luas_bangunan)
                        ->where('max_luas_bangunan','>=',$this->luas_bangunan)
                        ->first();
            if($result){
                 $this->estimasi_retribusi = $result->tarif ;
                 $this->tarif_found = true;
            }else{
                $this->estimasi_retribusi = 0;
                 $this->tarif_found = false;
            }
        }else{
            $this->estimasi_retribusi = 0;
            $this->tarif_found = false;
        }
     
    }

    public function store(){
        // dd($this->all());
        $this->validate([
            'pemilik_bangunan' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_lantai' => 'required',
            'fungsi_bangunan' => 'required',
            'tinggi_bangunan' => 'required',
            'jenis_bangunan' => 'required',
            'kondisi_bangunan' => 'required',
            'durasi_pemanfaatan' => 'required',
            'foto_bangunan' => 'required|image|max:5024',
        ]);
        $this->hitungPerkiraan();
        if($this->tarif_found == false){
            $this->alert('error', 'Tidak bisa melanjutkan karena Tarif tidak ditemukan, harap hubungi admin');
            return;
        }

        $save =  Permohonanimb::create([
            "nomor" => $this->nomor,
            "tanggal_permohonan" => $this->tanggal_permohonan,
            "pemohon_id" => $this->pemohon_id,
            "jenis_permohonan" => $this->jenis_permohonan ? $this->jenis_permohonan : "PBG",
            "pemilik_bangunan" => $this->pemilik_bangunan,
            "kecamatan_id" => $this->kecamatan_id,
            "kelurahan_id" => $this->kelurahan_id,
            "alamat" => $this->alamat,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "nama_bangunan" => $this->nama_bangunan,
            "fungsi_bangunan_id" => $this->fungsi_bangunan,
            "luas_bangunan" => $this->luas_bangunan,
            "jumlah_lantai" => $this->jumlah_lantai,
            "tinggi_bangunan" => $this->tinggi_bangunan,
            "jenis_bangunan_id" => $this->jenis_bangunan,
            "kondisi_bangunan" => $this->kondisi_bangunan,
            "durasi_pemanfaatan" => $this->durasi_pemanfaatan,
            "status_permohonan" => $this->status_permohonan,
            "foto_bangunan" => $this->foto_bangunan->store('foto_bangunan','public'),
            "keterangan" => $this->keterangan,
        ]);
        if($save){
           Retribusi::create([
                'permohonan_id' => $save->id,
                'jenis' =>  $this->jenis_permohonan ? $this->jenis_permohonan : "PBG",
                'tanggal_tagihan' => date('Y-m-d'),
                'tanggal_bayar'=> null,
                'jumlah_tagihan' => $this->estimasi_retribusi,
                'jumlah_bayar' => 0,
                'keterangan' => "Estimasi Perkiraan Retribusi",
                'status_pembayaran' => 'Belum Dibayar',
            ]);

            $this->alert('success', 'Permohonan Berhasil diajukan, harap menunggu proses verifikasi, dan lanjutkan pembayaran retribusi');
            return redirect()->route('retribusi.pemohon');
        }
        return redirect()->route('home');
    }

}
