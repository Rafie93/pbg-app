<?php

namespace App\Livewire\Admin;

use App\Models\PenerbitanImb;
use App\Models\Permohonanimb;
use App\Models\Reklame;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardControl extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $role;
    public $total_imb_bjm_timur=0,$total_imb_bjm_barat=0,$total_imb_bjm_selatan=0,$total_imb_bjm_utara=0,$total_imb_bjm_tengah=0;
    public $option_districts=[],$city_selected=6371,$labels=[],$datas=[],$city_name_selected="Kota Banjarmasin", $search;
    public $total_aju_bjm_timur=0,$total_aju_bjm_barat=0,$total_aju_bjm_selatan=0,$total_aju_bjm_utara=0,$total_aju_bjm_tengah=0;
    public $total_proses_bjm_timur=0,$total_proses_bjm_barat=0,$total_proses_bjm_selatan=0,$total_proses_bjm_utara=0,$total_proses_bjm_tengah=0;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(){
        $this->role = auth()->user()->role;
    }


    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $permohonanimb = Permohonanimb::latest()
                                        ->where('status_permohonan','Diajukan')
                                        ->paginate(10);
         $permohonanreklame = Reklame::orderBy('id','desc')
                                        ->where('status_permohonan','Diajukan')
                                        ->paginate(10);
        $this->total_imb_bjm_barat = PenerbitanImb::whereHas('permohonan',function($query){
                                                $query->where('kecamatan_id',6371030);
                                            })->count();
        $this->total_imb_bjm_timur = PenerbitanImb::whereHas('permohonan',function($query){
                                                $query->where('kecamatan_id',6371020);
                                            })->count();
        $this->total_imb_bjm_selatan = PenerbitanImb::whereHas('permohonan',function($query){
                                                $query->where('kecamatan_id',6371010);
                                            })->count();
        $this->total_imb_bjm_utara = PenerbitanImb::whereHas('permohonan',function($query){
                                                $query->where('kecamatan_id',6371040);
                                            })->count();
        $this->total_imb_bjm_tengah = PenerbitanImb::whereHas('permohonan',function($query){
                                                $query->where('kecamatan_id',6371031);
                                            })->count();
        // PENGAJUAN
        $this->total_aju_bjm_barat = Permohonanimb::where('kecamatan_id',6371030)->where('status_permohonan','Diajukan')->count();
        $this->total_aju_bjm_timur = Permohonanimb::where('kecamatan_id',6371020)->where('status_permohonan','Diajukan')->count();
        $this->total_aju_bjm_selatan = Permohonanimb::where('kecamatan_id',6371010)->where('status_permohonan','Diajukan')->count();
        $this->total_aju_bjm_utara = Permohonanimb::where('kecamatan_id',6371040)->where('status_permohonan','Diajukan')->count();
        $this->total_aju_bjm_tengah = Permohonanimb::where('kecamatan_id',6371031)->where('status_permohonan','Diajukan')->count();

        // PROSES
        $this->total_proses_bjm_barat = Permohonanimb::where('kecamatan_id',6371030)->where('status_permohonan','Diproses')->count();
        $this->total_proses_bjm_timur = Permohonanimb::where('kecamatan_id',6371020)->where('status_permohonan','Diproses')->count();
        $this->total_proses_bjm_selatan = Permohonanimb::where('kecamatan_id',6371010)->where('status_permohonan','Diproses')->count();
        $this->total_proses_bjm_utara = Permohonanimb::where('kecamatan_id',6371040)->where('status_permohonan','Diproses')->count();
        $this->total_proses_bjm_tengah = Permohonanimb::where('kecamatan_id',6371031)->where('status_permohonan','Diproses')->count();
                                            
        return view('livewire.admin.dashboard-control',compact('permohonanimb','permohonanreklame'));
    }

    public function searchData(){
        $this->dispatch('refresh');
        return redirect()->route('dashboard',[
            'type' => $this->tab_selected,
            'district' => $this->city_selected,
        ]);
    }
   
}
