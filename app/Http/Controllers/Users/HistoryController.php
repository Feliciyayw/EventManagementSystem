<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

use App\Models\Berita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\VwDonasiMakanan;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $data = [
            'title' => "Data History",
            'history_donasi' => VwDonasiMakanan::where('vw_donasi_makanan.created_by', Auth::user()->id)->join('pengiriman', 'pengiriman.id_donasi_makanan', '=', 'vw_donasi_makanan.id_donasi_makanan')->whereIn('status_makanan', ['selesai'])->get(),
        ];
    

        return view('users/history')->with('data', $data);
    }

    public function detail($id_donasi_makanan)
    {
        $data = [
            'title' => "Detail Data History",
            'detail_history' => VwDonasiMakanan::where('vw_donasi_makanan.created_by', Auth::user()->id)->join('pengiriman', 'pengiriman.id_donasi_makanan', '=', 'vw_donasi_makanan.id_donasi_makanan')->whereIn('status_makanan', ['selesai'])->first(),
        ];
    

        return view('users/detail_history')->with('data', $data);
    }

    


}
