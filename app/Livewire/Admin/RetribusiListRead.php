<?php

namespace App\Livewire\Admin;

use App\Imports\EkrafImport;
use App\Models\PelakuEkraf;
use App\Models\Retribusi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RetribusiListRead extends Component
{
    use WithFileUploads, LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $belum_dibayar = 0,$sudah_dibayar = 0,$sudah_verifikasi = 0;
    public $filter = "";
    public $file_import;
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $this->belum_dibayar = Retribusi::where('status_pembayaran','Belum Dibayar')->count();
        $this->sudah_dibayar = Retribusi::where('status_pembayaran','Dibayar')->count();
        $this->sudah_verifikasi = Retribusi::where('status_pembayaran','Pembayaran Diterima')->count();

        $retribusis = Retribusi::latest()
                    ->when($this->filter,function($query){
                        $query->where('status_pembayaran',$this->filter);
                    })
                    ->get();
        return view('livewire.admin.retribusi-list-read',compact('retribusis'));
    }
    public function filterData($filter){
        $this->filter = $filter;
    }
}
   
