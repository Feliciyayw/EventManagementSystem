<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JoinEvent;

use App\Models\Galeri;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataJoinEventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Join Event",
            'join_event' => JoinEvent::selectRaw("*")
                        ->join('event', 'event.id_event', '=', 'join_event.id_event')
                        ->join('need_crew', 'join_event.id_need_crew', '=', 'need_crew.id_need_crew')
                        ->join('users', 'users.id', '=', 'join_event.created_by')
                        ->get(),
        ];

        return view('admin/datajoinevent')->with('data', $data);
    }


    public function update(Request $request){

        $id_join_event = $request->id_join_event;
        $data = [
            'updated_by' => Auth::user()->id,
            'status_join' => $request->konfirmasi,
        ];

        JoinEvent::where('id_join_event', $id_join_event)->update($data);
        return redirect()->back()->with('suc_message', 'Event Joined Succesfully!');

        
    }


    public function delete($id_join_event){
        JoinEvent::where('id_join_event', $id_join_event)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }


    public function history()
    {
        date_default_timezone_set('Asia/Jakarta');

        $hari_ini = date('Y-m-d H:i:s');
        $data = [
            'title' => "Data Join Event",
            'join_event' => JoinEvent::selectRaw("*")
                        ->join('event', 'event.id_event', '=', 'join_event.id_event')
                        ->join('users', 'users.id', '=', 'join_event.created_by')
                        ->where('event.tanggal_mulai','<=', $hari_ini)
                        ->get(),
        ];

        return view('admin/datahistoryjoin')->with('data', $data);
    }

    


}
