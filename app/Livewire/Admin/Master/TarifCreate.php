<?php

namespace App\Livewire\Admin\Master;

use App\Models\Tarif;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

class TarifCreate extends Component
{
    use LivewireAlert;
    public $jenis_permohonan="PBG", $kepemilikan=[], $option_fungsi = [],$durasi_pemanfaatan=[],
    $fungsi_bangunan_id=[],  $min_luas_bangunan, $max_luas_bangunan, $min_jumlah_lantai, $max_jumlah_lantai, $tarif;
    
    public function mount(){
        $this->option_fungsi = \App\Models\FungsiBangunan::where('status','Aktif')->get();
    }

    #[Layout('components.layouts.admin-app')]
    
    public function render()
    {
        return view('livewire.admin.master.tarif-create');
    }
    public function store(){
        $this->validate([
            'jenis_permohonan' => 'required',
            'kepemilikan' => 'required',
            'fungsi_bangunan_id' => 'required',
            'min_luas_bangunan' => 'required|numeric',
            'max_luas_bangunan' => 'required|numeric',
            'min_jumlah_lantai' => 'required|numeric',
            'max_jumlah_lantai' => 'required|numeric',
            'tarif' => 'required|numeric',
        ]);
        // validasi jika min_luas_bangunan lebih besar dari max_luas_bangunan
        if($this->min_luas_bangunan > $this->max_luas_bangunan){
            $this->alert('error', 'Min Luas Bangunan tidak boleh lebih besar dari Max Luas Bangunan');
            return;
        }
        // validasi jika min_jumlah_lantai lebih besar dari max_jumlah_lantai
        if($this->min_jumlah_lantai > $this->max_jumlah_lantai){
            $this->alert('error', 'Min Jumlah Lantai tidak boleh lebih besar dari Max Jumlah Lantai');
            return;
        }
        // validasi jika sama data
        $tarifsama = Tarif::where('jenis_permohonan', $this->jenis_permohonan)
        ->where('kepemilikan', $this->kepemilikan)
        ->where('fungsi_bangunan_id', $this->fungsi_bangunan_id)
        ->where('min_luas_bangunan', $this->min_luas_bangunan)
        ->where('min_jumlah_lantai', $this->min_jumlah_lantai)
        ->count();
        if($tarifsama > 0){
            $this->alert('error', 'Data sudah ada dengan sama minimal luas bangunan dan jumlah lantai');
            return;
        }

        // simpan data berdasarkan banyak data checkbox kepemilikan, fungsi_bangunan_id dan durasi
        foreach($this->kepemilikan as $key => $value){
            foreach($this->fungsi_bangunan_id as $key2 => $value2){
                foreach($this->durasi_pemanfaatan as $key3 => $value3){
                    Tarif::create([
                        'jenis_permohonan' => $this->jenis_permohonan,
                        'kepemilikan' => $value,
                        'fungsi_bangunan_id' => $value2,
                        'durasi_pemanfaatan' => $value3,
                        'min_luas_bangunan' => $this->min_luas_bangunan,
                        'max_luas_bangunan' => $this->max_luas_bangunan,
                        'min_jumlah_lantai' => $this->min_jumlah_lantai,
                        'max_jumlah_lantai' => $this->max_jumlah_lantai,
                        'tarif' => $this->tarif,
                    ]);
                }
            }
        }
   
        // alert sukses


        $this->alert('success', 'Data berhasil disimpan');
        $this->reset();
        return redirect()->route('master.tarif');
    }

    public function delete($id){
        Tarif::find($id)->delete();
        $this->alert('success', 'Data berhasil dihapus');
    }
}
