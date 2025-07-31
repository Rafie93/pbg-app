<?php

namespace App\Livewire;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MyProfileControl extends Component
{
    use LivewireAlert;
    public $name, $email, $password,$user_id,$phone,$pemohons,$jenis_identitas="KTP",$no_identitas,
    $pekerjaan,$alamat,$city_id="6371",$kecamatan_id,$kelurahan_id;
    public $option_city=[],$option_district=[],$option_village=[];
    public function mount(){
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_id = $user->id;
        $this->pemohons =Pemohon::where('user_id',$user->id)->first();
        $this->pemohons ? $this->phone = Pemohon::where('user_id',$user->id)->first()->no_hp : $this->phone = '';
        $this->option_city = DB::table("citys")->where("state_id",63)->get();
        $this->getDistrict();
        if ($this->pemohons) {
            $this->jenis_identitas = $this->pemohons->jenis_identitas;
            $this->no_identitas = $this->pemohons->no_identitas;
            $this->pekerjaan = $this->pemohons->pekerjaan;
            $this->alamat = $this->pemohons->alamat;
            $this->kecamatan_id = $this->pemohons->kecamatan_id;
            $this->kelurahan_id = $this->pemohons->kelurahan_id;
            $this->getVillage();
        }
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

    public function render()
    {
        return view('livewire.my-profile-control');
    }

    public function update(){
        $this->validate([
            'name'=> 'required',
            'email'=> 'required'
        ]);
        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if($this->password){
            $user->password = bcrypt($this->password);
        }
        $user->save();
        // UPDATE PROFI PEMOHON
        $pemohon = Pemohon::where('user_id',$this->user_id)->
        update([
            'jenis_identitas' => $this->jenis_identitas,
            'no_identitas' => $this->no_identitas,
            'pekerjaan' => $this->pekerjaan,
            'alamat' => $this->alamat,
            'kecamatan_id' => $this->kecamatan_id,
            'kelurahan_id' => $this->kelurahan_id
            ]);
        $this->alert('success','Akun Berhasil diperbaharui');
        return redirect()->route('profile');
    }
}
