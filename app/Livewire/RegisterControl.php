<?php

namespace App\Livewire;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RegisterControl extends Component
{
    use LivewireAlert;

    public $name, $email, $password, $jenis_identitas="KTP",$no_identitas,$phone,
    $pekerjaan,$alamat,$city_id="6371",$kecamatan_id,$kelurahan_id;
    public $option_city=[],$option_district=[],$option_village=[];
    
    protected $listeners = ['refresh' => '$refresh'];

    public function mount(){
        $this->option_city = DB::table("citys")->where("state_id",63)->get();
        $this->getDistrict();
    }
    public function render()
    {
        return view('livewire.register-control');
    }
 

    public function getDistrict(){
        if($this->city_id){
            $this->option_district = DB::table("districts")->where("city_id",$this->city_id)->get();
        }
    }
    public function getVillage(){
        if($this->kecamatan_id){
            $this->option_village = DB::table("villages")->where("district_id",$this->kecamatan_id)->get();
        }
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:pemohon,no_hp',
            'password' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required',
            'city_id' => 'required',
            'kecamatan_id'=> 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => '3'
            ]);

            $pemohon = Pemohon::create([
                'user_id' => $user->id,
                'nama' => $this->name,
                'jenis_identitas' => $this->jenis_identitas,
                'no_identitas' => $this->no_identitas,
                'no_hp' => $this->phone,
                'pekerjaan' => $this->pekerjaan,
                'alamat' => $this->alamat,
                'kecamatan_id' => $this->kecamatan_id,
                'kelurahan_id' => $this->kelurahan_id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error','Gagal mendaftar');
            return;
        }
        
        $this->alert('success','Terimakasih sudah mendaftar anda akan diarahkan ke halaman login');
        sleep(2);
        return redirect()->route('login');
    }
}
