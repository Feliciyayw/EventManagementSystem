<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Event;
use App\Models\NeedCrew;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $event = Event::selectRaw('*, created_at as need_crew')->orderby('tanggal_mulai', 'ASC')->limit(4)->get();

        foreach ($event as $key => $value) {
            $value->need_crew = NeedCrew::where('id_event', $value->id_event)->get();
        }
        $data = [
            'event' => $event,
            'title' => "Halaman Home",
            'informasi' => Informasi::join('users', 'users.id', '=', 'informasi.id_users')->get(),
        ];

        return view('users/index')->with('data', $data);
    }

    public function detail_berita($id_informasi){
        $data = [
            'title' => "Halaman Detail Informasi",
            'detail' => Informasi::join('users', 'users.id', '=', 'informasi.id_users')->where('id_informasi', $id_informasi)->first(),
        ];

        return view('users/detailberita')->with('data', $data);
    }
}
