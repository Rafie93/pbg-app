<?php

namespace App\Http\Controllers;

use App\Imports\EkrafImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //
    public function index(){
        return view("import");
    }

    public function store(Request $request){
    		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file'); 
		$nama_file = rand().$file->getClientOriginalName(); 
		$file->move('file_ekraf',$nama_file);
		// import data
		Excel::import(new EkrafImport, public_path('/file_ekraf/'.$nama_file));
 
    }
}

