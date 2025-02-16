<?php

namespace App\Livewire\Admin\Master;

use App\Models\JenisBangunan;
use App\Models\JenisKerjasama;
use Livewire\Component;
use Livewire\Attributes\Layout;


class JenisBangunanRead extends Component
{
    #[Layout('components.layouts.admin-app')]

    public function render()
    {
        $jenisbangunan = JenisBangunan::latest()->get();

        return view('livewire.admin.master.jenis-bangunan-read',compact('jenisbangunan'));
    }
    
}
