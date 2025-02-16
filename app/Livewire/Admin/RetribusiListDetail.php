<?php

namespace App\Livewire\Admin;

use App\Models\PelakuEkraf;
use App\Models\Retribusi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RetribusiListDetail extends Component
{
    use LivewireAlert;

    public $retribusi_id,$tab_selected="produk";
    public function mount($id){
        $this->retribusi_id = $id;
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $data = Retribusi::find($this->retribusi_id);
        // dd($data->permohonan);
        return view('livewire.admin.retribusi-list-detail',compact('data'));
    }

    public function selecttab($id){
        $this->tab_selected = $id;
    }

    public function terima(){
        Retribusi::find($this->retribusi_id)->update([
            'status_pembayaran'=>'Pembayaran Diterima',
            'jumlah_bayar'=>Retribusi::find($this->retribusi_id)->jumlah_tagihan
        ]);
        $this->alert('success', 'Retribusi berhasil diterima');
    }
    public function tolak(){
        Retribusi::find($this->retribusi_id)->update(['status_pembayaran'=>'Pembayaran Ditolak']);
        $this->alert('success', 'Retribusi berhasil ditolak');
    }
    public function delete($id){
        Retribusi::find($id)->delete();
        $this->alert('success', 'Data berhasil dihapus');
        return redirect()->route('retribusi.list');
    }
}
