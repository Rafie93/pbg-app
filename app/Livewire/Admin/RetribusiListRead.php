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

    public $file_import;
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $retribusis = Retribusi::all();
        return view('livewire.admin.retribusi-list-read',compact('retribusis'));
    }
}
   
