<?php

namespace App\Livewire;

use App\Models\FungsiBangunan;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use App\Models\Retribusi;
use App\Models\Tarif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class HomeControl extends Component
{
    use WithPagination, LivewireAlert;
    public $isLogin = false,$search,$role=0,$jenis_permohonan="PBG";
    public $option_fungsi_bangunan=[],$jumlah_lantai,$luas_bangunan,$fungsi_bangunan,$durasi_pemanfaatan,$kepemilikan;
    public $estimasi_retribusi=0;
    public function mount()
    {
        $this->option_fungsi_bangunan = FungsiBangunan::where('status','Aktif')->get();

        $this->isLogin = Auth::check();
        
        if($this->isLogin){
            $this->role = Auth::user()->role;
        }
    }
    public function changeValue(){}
    public function render()
    {
        if ($this->isLogin && $this->role == 3) {
            $daftarpermohonan = Permohonanimb::latest()
                ->when($this->search, function ($query) {
                    $query->where('nomor', 'like', '%' . $this->search . '%');
                })
                ->where('pemohon_id', Auth::user()->pemohon()->id)
                ->paginate(5);

            $daftarpermohonanReklame = Reklame::orderBy('id','desc')
                ->when($this->search, function ($query) {
                    $query->where('nomor', 'like', '%' . $this->search . '%');
                })
                ->where('pemohon_id', Auth::user()->pemohon()->id)
                ->paginate(5);
            return view('livewire.home-pemohon', ['daftarpermohonan' => $daftarpermohonan,
            'daftarpermohonanReklame' => $daftarpermohonanReklame]);

        }elseif($this->isLogin && ($this->role == 2 || $this->role == 1 || $this->role == 4)){
            // return redirect()->route('dashboard');
            return view('livewire.home-control');
        }else {

            return view('livewire.home-control');
        }
    }

    public function hitungPerkiraan(){
        if ($this->jenis_permohonan=='PBG') {
            $this->validate([
                'fungsi_bangunan' => 'required',
                'jumlah_lantai' => 'required',
                'luas_bangunan' => 'required',
                'durasi_pemanfaatan' => 'required',
                'kepemilikan' => 'required',
            ]);
            $result = Tarif::orderBy('tarif','desc')
                            ->where('jenis_permohonan','PBG')
                            ->where('fungsi_bangunan_id',$this->fungsi_bangunan)
                            ->where('kepemilikan',$this->kepemilikan)
                            ->where('durasi_pemanfaatan',$this->durasi_pemanfaatan)
                            ->where('min_jumlah_lantai','<=',$this->jumlah_lantai)
                            ->where('max_jumlah_lantai','>=',$this->jumlah_lantai)
                            ->where('min_luas_bangunan','<=',$this->luas_bangunan)
                            ->where('max_luas_bangunan','>=',$this->luas_bangunan)
                            ->first();
            if($result){
                $this->estimasi_retribusi = $result->tarif ;
                $this->alert('success', 'Tarif ditemukan');
            }else{
                $this->estimasi_retribusi = 0;
                $this->alert('error', 'Tarif tidak ditemukan');
            }
        }else{
            $this->validate([
                'luas_bangunan' => 'required',
                'durasi_pemanfaatan' => 'required',
                'kepemilikan' => 'required',
            ]);
            $result = Tarif::orderBy('durasi_pemanfaatan','asc')
                            ->where('jenis_permohonan','Reklame')
                            ->where('kepemilikan',$this->kepemilikan)
                            ->where('min_luas_bangunan','<=',$this->luas_bangunan)
                            ->where('max_luas_bangunan','>=',$this->luas_bangunan)
                            ->first();
            if($result){
                $this->estimasi_retribusi = $result->tarif *  $this->durasi_pemanfaatan ;
                $this->alert('success', 'Tarif ditemukan');
            }else{
                $this->estimasi_retribusi = 0;
                $this->alert('error', 'Tarif tidak ditemukan');
            }
        }
        
    }

    public function destroy($id){
        $permohonan = Permohonanimb::find($id);
        if($permohonan){
            $permohonan->delete();
            Retribusi::where('permohonan_id',$id)->delete();
            $this->alert('success', 'Data berhasil dihapus');
        }else{
            $this->alert('error', 'Data tidak ditemukan');
        }
    }

    public function destroy2($id){
        $permohonan = Reklame::find($id);
        if($permohonan){
            $permohonan->delete();
            Retribusi::where('permohonan_id',$id)->delete();
            $this->alert('success', 'Data berhasil dihapus');
        }else{
            $this->alert('error', 'Data tidak ditemukan');
        }
    }
}
