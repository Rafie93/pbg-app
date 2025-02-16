<?php

namespace App\Livewire;

use App\Models\Permohonanimb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HomeControl extends Component
{
    use WithPagination;
    public $isLogin = false,$search,$role=0;

    public function mount()
    {
        $this->isLogin = Auth::check();
        
        if($this->isLogin){
            $this->role = Auth::user()->role;
        }
    }
    
    public function render()
    {
        if ($this->isLogin && $this->role == 3) {
            $daftarpermohonan = Permohonanimb::latest()
                ->when($this->search, function ($query) {
                    $query->where('nomor', 'like', '%' . $this->search . '%');
                })
                ->where('pemohon_id', Auth::user()->pemohon()->id)
                ->paginate(5);
            return view('livewire.home-pemohon', ['daftarpermohonan' => $daftarpermohonan]);

        }elseif($this->isLogin && ($this->role == 2 || $this->role == 1 || $this->role == 4)){
            // return redirect()->route('dashboard');
            return view('livewire.home-control');
        }else {

            return view('livewire.home-control');
        }
    }
}
