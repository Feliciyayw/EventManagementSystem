<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    public function login()
    {
        return view('auth.login');
    }


    public function verifikasi($id){
        $update = [
            'aktiv' => '1'
        ];

        User::where('id', $id)->update($update);

        return redirect('login')->with('suc_message', 'Data Berhasil Diverifikasi!');;

    }

}
