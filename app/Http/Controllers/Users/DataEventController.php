<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\NeedCrew;
use App\Models\Berita;
use App\Models\DetailEvent;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataEventController extends Controller
{


    
    public function index()
    {
        $event = Event::selectRaw('*, event.created_at as need_crew')->orderby('tanggal_mulai', 'ASC')->get();

        foreach ($event as $key => $value) {
            $value->need_crew = NeedCrew::where('id_event', $value->id_event)->get();
        }
        $data = [
            'title' => "Data Event",
            'event' => $event,
        ];
    

        return view('users/event')->with('data', $data);
    }

    public function detail($id_event)
    {
        $data = [
            'title' => "Data Event",
            'crew' => NeedCrew::where('id_event', $id_event)->get(),
            'detail' => Event::where('id_event', $id_event)->first(),
        ];
    

        return view('users/detail_event')->with('data', $data);
    }


}
