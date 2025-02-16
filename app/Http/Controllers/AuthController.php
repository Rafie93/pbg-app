<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function index(Request $request){
        return view('livewire.admin.login');
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        // with role 1,2,4
        $data = [
            'email' => $request->email,
            'password' => $request->password,

        ];

        
        if (Auth::Attempt($data)) {
            if($user = Auth::user()->role == 3){
                return redirect()->route('home');
            }
            return redirect()->route('dashboard');
        }else{
            $validator->errors()->add(
                'password', 'Akun tidak ditemukan'
            );
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }
}
