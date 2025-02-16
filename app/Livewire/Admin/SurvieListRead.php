<?php

namespace App\Livewire\Admin;

use App\Models\News;
use App\Models\Survie;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class SurvieListRead extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $app_title="Survie List",$role,$label="",$petugas_id;
    
    #[Layout('components.layouts.admin-app')]

    public function mount(){
        $this->role = auth()->user()->role;
        if($this->role == 1 || $this->role == 2){
            $this->label = "Penugasan";
        }else if($this->role ==4){
            $this->label = "Pemeriksaan";
            $this->petugas_id = auth()->user()->id;
        }

    }
    public function render()
    {
        $survie = Survie::orderBy('foto_survie','asc')
            ->orderBy('created_at','desc')
            ->when($this->label == "Pemeriksaan",function($q){
                $q->where('petugas_id',$this->petugas_id);
            })

            ->get();
        return view('livewire.admin.survie-list-read',compact('survie'));
    }

    public function destroy($id){
        $survie = Survie::find($id);
        // jika tida
        if($survie->foto_survie){
            $this->alert('warning','Data tidak bisa dihapus karena sudah disurvie');
            return;
        }
        $survie->delete();
        session()->flash('success','Data Berhasil dihapus');
    }
}
