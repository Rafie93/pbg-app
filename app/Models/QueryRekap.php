<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
* Awb Query Object
*/
class QueryRekap
{
    function reklameTotalBerizin($kelurahan_id){
        $penerbitan = PenerbitanImb::select(
                          DB::raw('count(*) as total_berizin'),
                    )
                    ->leftJoin('reklame', 'reklame.id', '=', 'penerbitan.permohonan_id')
                    ->where('reklame.kelurahan_id',$kelurahan_id)
                    ->where('jenis','Reklame')
                    ->first();
                    
       return $penerbitan ? $penerbitan->total_berizin : 0;
                
    }

    function total_bangunan($kelurahan_id){
        $pbg = Permohonanimb::where('kelurahan_id',$kelurahan_id)->count();
        $reklame = Reklame::where('kelurahan_id',$kelurahan_id)->count();
        return $pbg + $reklame;
    }

    function total_berizin($kelurahan_id){
        $penerbitan = PenerbitanImb::select(
                          DB::raw('count(*) as total_berizin'),
                    )
                    ->leftJoin('reklame', 'reklame.id', '=', 'penerbitan.permohonan_id')
                    ->where('reklame.kelurahan_id',$kelurahan_id)
                    ->where('jenis','Reklame')
                    ->first();

         $penerbitanpbg = PenerbitanImb::select(
                        DB::raw('count(*) as total_berizin'),
                  )
                  ->leftJoin('permohonan', 'permohonan.id', '=', 'penerbitan.permohonan_id')
                  ->where('permohonan.kelurahan_id',$kelurahan_id)
                  ->where('jenis','PBG')
                  ->first();
                    
       $reklame = $penerbitan ? $penerbitan->total_berizin : 0;
       $pbg = $penerbitanpbg ? $penerbitanpbg->total_berizin : 0;
               
       return $reklame + $pbg;
    }

    function total_diproses($kelurahan_id){
        $pbg = Permohonanimb::where('kelurahan_id',$kelurahan_id)->where('status_permohonan','Diproses')->count();
        $reklame = Reklame::where('kelurahan_id',$kelurahan_id)->where('status_permohonan','Diproses')->count();
        return $pbg + $reklame;
    }
    function total_ditolak($kelurahan_id){
        $pbg = Permohonanimb::where('kelurahan_id',$kelurahan_id)->where('status_permohonan','Ditolak')->count();
        $reklame = Reklame::where('kelurahan_id',$kelurahan_id)->where('status_permohonan','Ditolak')->count();
        return $pbg + $reklame;
    }
}