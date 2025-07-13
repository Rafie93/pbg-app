<?php

namespace App\Livewire\Admin\Master;

use App\Models\Tarif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TarifReklameCreate extends Component
{
    use LivewireAlert;
    public $jenis_reklame,$durasi,$tarif,$min_ukuran,$max_ukuran,$selectId;
    
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.master.tarif-reklame-create');
    }
    public function store(){
        $this->validate([
            'jenis_reklame' => 'required',
            'durasi' => 'required',
            'tarif' => 'required',
            'min_ukuran' => 'required',
            'max_ukuran' => 'required',
        ]);
        Tarif::updateOrCreate([
            'id' => $this->selectId
        ],[
            'jenis_permohonan' => 'Reklame',
            'kepemilikan' => $this->jenis_reklame,
            'durasi_pemanfaatan' => $this->durasi,
            'tarif' => $this->tarif,
            'min_luas_bangunan' => $this->min_ukuran,
            'max_luas_bangunan' => $this->max_ukuran,
        ]);
        $this->alert('success', 'Data Berhasil disimpan');
        return redirect()->route('master.tarif-reklame');
    }
}
