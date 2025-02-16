<?php

namespace App\Livewire\Admin\Master;

use App\Models\JenisBangunan;
use App\Models\JenisKerjasama;
use Livewire\Component;
use Livewire\Attributes\Layout;


class JenisBangunanCreate extends Component
{
    public $jenis_id,$nama;
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        return view('livewire.admin.master.jenis-bangunan-create');
    }
    public function mount($id=null){
        if($id){
            $this->jenis_id = $id;
            $s = JenisBangunan::find($id);
            $this->nama = $s->nama;
        }
    }

    public function store(){
        $this->validate([
            'nama'=> 'required|unique:jenis_bangunan,nama,'.$this->jenis_id,
        ]);
        $save = JenisBangunan::updateOrCreate([
            'id' => $this->jenis_id
        ],[
            'nama'=> $this->nama,
            ]);
          
        return redirect()->route('master.jenis-bangunan');    
    }
}
