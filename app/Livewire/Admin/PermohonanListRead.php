<?php

namespace App\Livewire\Admin;

use App\Models\Komunitas;
use App\Models\Permohonanimb;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class PermohonanListRead extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $permohonanimb = Permohonanimb::all();
        return view('livewire.admin.permohonan-list-read',[
            'permohonanimb' => $permohonanimb
        ]);
    }
}
