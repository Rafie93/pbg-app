<?php

namespace App\Livewire\Admin\Master;

use App\Models\FungsiBangunan;
use App\Models\Sektor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class FungsiCreate extends Component
{
    use WithFileUploads;
    public $nama,$status='Aktif',$fungsi_id;

    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        return view('livewire.admin.master.fungsi-create');
    }

    public function mount($id=null){
        if($id){
            $this->fungsi_id = $id;
            $s = FungsiBangunan::find($id);
            $this->nama = $s->nama;
            $this->status = $s->status;
        }
    }

    public function store(){
        $this->validate([
            'nama'=> 'required|unique:fungsi_bangunan,nama,'.$this->fungsi_id,
        ]);
        $save = FungsiBangunan::updateOrCreate([
            'id' => $this->fungsi_id
        ],[
            'nama'=> $this->nama,
            'status' => $this->status,
            ]);
         
       
        
        return redirect()->route('master.fungsi');    
    }
}
