<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\VwDonasiMakanan;

class DataAboutController extends Controller
{

    public function index()
    {
        $data = [
            'title' => "Data About",
        ];
    

        return view('users/about')->with('data', $data);
    }


    


}
