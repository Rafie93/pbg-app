<?php

namespace App\Livewire\Admin;

use App\Models\Komunitas;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class PermohonanListRead extends Component
{
    use WithPagination,LivewireAlert;
    public $app_title = "Permohonan PBG";
    protected $paginationTheme = 'bootstrap';

    
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $permohonanimb = Permohonanimb::latest()->get();
        $permohonanreklame = Reklame::orderBy('id','desc')->get();
        return view('livewire.admin.permohonan-list-read',[
            'permohonanimb' => $permohonanimb,
            'permohonanreklame' => $permohonanreklame
        ]);
    }
}
