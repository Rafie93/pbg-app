<?php

namespace App\Livewire\Admin;

use App\Models\Hexahelic;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HexaListDetail extends Component
{
    use LivewireAlert;

    public $ekraf_id,$tab_selected="kerjasama";
    public function mount($id){
        $this->ekraf_id = $id;
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $data = Hexahelic::find($this->ekraf_id);

        return view('livewire.admin.hexa-list-detail', ['data'=> $data]);
    }

    
    public function selecttab($id){
        $this->tab_selected = $id;
    }

    public function terima(){
        Hexahelic::find($this->ekraf_id)->update(['status'=>2]);
        $this->alert('success', 'Komunitas berhasil diterima');
    }
    public function tolak(){
        Hexahelic::find($this->ekraf_id)->update(['status'=>3]);
        $this->alert('success', 'Komunitas berhasil ditolak');
    }
}
