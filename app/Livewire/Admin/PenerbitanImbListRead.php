<?php

namespace App\Livewire\Admin;

use App\Models\Hexahelic;
use App\Models\PenerbitanImb;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class PenerbitanImbListRead extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $penerbitan = PenerbitanImb::all();
        return view('livewire.admin.penerbitan-list-read',compact('penerbitan'));
    }
}
