<?php

namespace App\Livewire;

use App\Models\FungsiBangunan;
use App\Models\JenisBangunan;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use App\Models\Retribusi;
use App\Models\Tarif;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class AjukanReklameControl extends Component
{
    use WithFileUploads, LivewireAlert;
    public $pemohons,$estimasi_retribusi=0,$tarif_found=false;
    public $nomor, $tanggal_permohonan,$pemohon_id,$jenis_permohonan,$pemilik_bangunan,
    $kecamatan_id,$kelurahan_id,$alamat,$latitude  = '-3.31900629751783561', $longitude = '114.5913495840888',$fungsi_bangunan,$luas_bangunan,
    $jumlah_lantai,$tinggi_bangunan,$jenis_bangunan,$kondisi_bangunan,$durasi_pemanfaatan,
    $status_permohonan,$foto_bangunan,$keterangan,$nama_bangunan,$city_id=6371;
    public $jenis_reklame,$teks_reklame,$ukuran,$jumlah_reklame;

    public $option_district = [], $option_village = [],
     $option_kondisi_bangunan = [], $option_durasi_pemanfaatan = [],$option_city = [];

 

    public function mount(){
        $auth = auth()->user();
        $this->pemohons = $auth->pemohon();
        $this->pemohon_id = $this->pemohons->id;
        $this->tanggal_permohonan = date('Y-m-d');
        $this->status_permohonan = "Diajukan";
        $this->option_city = DB::table(table: "citys")->where("state_id",63)->get();
        $this->kecamatan_id = $this->pemohons->kecamatan_id;
        $this->kelurahan_id = $this->pemohons->kelurahan_id;
        $this->nomor = date('y').date('m').date('d').'-'.rand(100,999);
        $this->getDistrict();
        $this->getVillage();

        // dd($this->pemohons);
    }

    public function render()
    {
        return view('livewire.ajukan-reklame-control');
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
        if($this->jenis_reklame && $this->durasi_pemanfaatan && $this->ukuran){
            $result = Tarif::orderBy('tarif','desc')
                        ->where('jenis_permohonan','Reklame')
                        ->where('kepemilikan',$this->jenis_reklame)
                        ->where('durasi_pemanfaatan',$this->durasi_pemanfaatan)
                        ->where('min_luas_bangunan','<=',$this->ukuran)
                        ->where('max_luas_bangunan','>=',$this->ukuran)
                        ->first();
            if($result){
                 $this->estimasi_retribusi = $result->tarif * ($this->jumlah_reklame ? $this->jumlah_reklame : 1) ;
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
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
            'kondisi_bangunan' => 'required',
            'durasi_pemanfaatan' => 'required',
            'jenis_reklame' => 'required',
            'teks_reklame' => 'required',
            'ukuran' => 'required|numeric',
            'jumlah_reklame' => 'required|numeric',
            'foto_bangunan' => 'required|image|max:5024',
        ]);
        $this->hitungPerkiraan();
        if($this->tarif_found == false){
            $this->alert('error', 'Tidak bisa melanjutkan karena Tarif tidak ditemukan, harap hubungi admin');
            return;
        }

        $save =  Reklame::create([
            "nomor" => $this->nomor,
            "tanggal_permohonan" => $this->tanggal_permohonan,
            "pemohon_id" => $this->pemohon_id,
            "kecamatan_id" => $this->kecamatan_id,
            "kelurahan_id" => $this->kelurahan_id,
            "alamat" => $this->alamat,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "jenis_reklame" => $this->jenis_reklame,
            "teks_reklame" => $this->teks_reklame,
            "jumlah_reklame" => $this->jumlah_reklame,
            "ukuran" => $this->ukuran,
            "kondisi_bangunan" => $this->kondisi_bangunan,
            "durasi_pemanfaatan" => $this->durasi_pemanfaatan,
            "status_permohonan" => $this->status_permohonan,
            "foto_bangunan" => $this->foto_bangunan->store('foto_bangunan','public'),
            "keterangan" => $this->keterangan,
        ]);
        if($save){
           Retribusi::create([
                'permohonan_id' => $save->id,
                'jenis' =>  $this->jenis_permohonan ? $this->jenis_permohonan : "Reklame",
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
        return redirect()->route('retribusi.pemohon');
    }
}
