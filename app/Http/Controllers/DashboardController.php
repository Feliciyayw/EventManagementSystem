<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Event;




class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
       
         
        $data = [
            'title' => "Dashboard ",
            'jumlah_event' => Event::selectRaw('*, updated_at as need_crew')->get()->count(),
            'jumlah_pengunjung' => User::where('hak_akses', 'pengunjung')->get()->count(),
            'jumlah_admin' => User::where('hak_akses', 'admin')->get()->count(),
        ];

        return view('admin/dashboard')->with('data', $data);
    
            
            
        

    }
}
