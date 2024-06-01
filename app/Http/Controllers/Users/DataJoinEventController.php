<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\JoinEvent;

use App\Models\Berita;
use App\Models\DetailEvent;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataJoinEventController extends Controller
{
  

 
    
    public function index()
    {
        $data = [
            'title' => "Data Join Event",
            'join_event' => JoinEvent::selectRaw("*")
                        ->join('event', 'event.id_event', '=', 'join_event.id_event')
                        ->join('users', 'users.id', '=', 'join_event.created_by')
                        ->join('need_crew', 'join_event.id_need_crew', '=', 'need_crew.id_need_crew')
                        ->where('join_event.created_by', Auth::user()->id)
                        ->get(),
        ];

        return view('users/joinevent')->with('data', $data);
    }


    // public function insert($id_event){


    //     $cek_event = JoinEvent::where('id_event', $id_event)->where('created_by',Auth::user()->id)->get()->count();

    //     if($cek_event > 0){
    //         return redirect()->back()->with('err_message', 'Event Data Has Been Followed!');
    //     }else{
    //         $data = [
    //             'id_event' => $id_event,
    //             'created_by' => Auth::user()->id,
    //             'status_join' => 'Pending',
    //         ];
    
    //         JoinEvent::insert($data);
    //         return redirect('join-event-users')->with('suc_message', 'Join Event Succesfully!');

    //     }
    // }


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
                        ->where('join_event.created_by', Auth::user()->id)
                        ->get(),
        ];

        return view('users/historyjoin')->with('data', $data);
    }


    public function insert_join(Request $request){

        $id_event = $request->id_event;
        $cek_event = JoinEvent::where('id_event', $id_event)->where('created_by',Auth::user()->id)->get()->count();

        if($cek_event > 0){
            return redirect()->back()->with('err_message', 'This event is no longer accepting any staff. Please try to find another event!');
        }else{
            $data = [
                'id_event' => $id_event,
                'id_need_crew' => $request->id_need_crew,
                'created_by' => Auth::user()->id,
                'status_join' => 'Pending',
            ];
    
            JoinEvent::insert($data);
            return redirect('join-event-users')->with('suc_message', 'Join Event Succesfully!');

        }
    }


}
