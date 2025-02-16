<?php

namespace App\Livewire\Admin\Master;

use App\Models\FungsiBangunan;
use Livewire\Component;
use Livewire\Attributes\Layout;

class FungsiRead extends Component
{
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $fungsis = FungsiBangunan::latest()->get();
        return view('livewire.admin.master.fungsi-read',compact('fungsis'));
    }
}
