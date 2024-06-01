<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\NeedCrew;
use App\Models\DetailEvent;
use App\Models\JoinEvent;
use App\Models\Berita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataEventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $event = Event::selectRaw('*, updated_at as need_crew')->get();

        foreach ($event as $key => $value) {
            $value->need_crew = NeedCrew::where('id_event', $value->id_event)->get();
        }
        $data = [
            'title' => "Data Event",
            'event' => $event,
        ];

        return view('admin/dataevent')->with('data', $data);
    }

    public function detail($id_event)
    {
        $join_event = JoinEvent::selectRaw("*")
                    ->join('event', 'event.id_event', '=', 'join_event.id_event')
                    ->join('users', 'users.id', '=', 'join_event.created_by')
                    ->join('need_crew', 'join_event.id_need_crew', '=', 'need_crew.id_need_crew')
                    ->where('event.id_event', $id_event)
                    ->where('join_event.status_join', 'Accepted')
                    ->get();
        $data = [
            'title' => "Data Event",
            'event' => Event::where('id_event', $id_event)->first(),
            'need_crew' => NeedCrew::where('id_event', $id_event)->get(),
            'join_event' => $join_event,
            'detail' => DetailEvent::join('event', 'detail_event.id_event', '=', 'event.id_event')->join('users', 'detail_event.id_users', '=', 'users.id')->where('detail_event.id_event', $id_event)->get(),
        ];

        return view('admin/detailevent')->with('data', $data);
    }
   
    public function insert(Request $request){

        $berkas = $request->file('gambar');
        $nama_document = time()."_".$berkas->getClientOriginalName();
        $tujuan_upload = 'event';

        $berkas->move($tujuan_upload,$nama_document);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'crew' => $request->crew,
            'size_of_event' => $request->size_of_event,
            'lokasi' => $request->lokasi,
            'gambar_event' => $nama_document,
            'created_at' => Carbon::now(),
        ];



        $insert = Event::create($data);

        $id_event = $insert->id;

        $need_crew = $request->need_crew;

        foreach ($need_crew as $key => $value) {
            $data_crew = [
                'need_crew' => $value,
                'id_event' => $id_event,
            ];

            NeedCrew::insert($data_crew);
        }
        

        return redirect()->back()->with('suc_message', 'Data saved successfully!');
    }

    public function update(Request $request){

        $id_event = $request->id_event;

        NeedCrew::where('id_event', $id_event)->delete();
        
        $berkas = $request->file('gambar');
        if($berkas == NULL){
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'crew' => $request->crew,
                'size_of_event' => $request->size_of_event,
                'lokasi' => $request->lokasi,
            ];
    
        }else{
            $nama_document = time()."_".$berkas->getClientOriginalName();
            $tujuan_upload = 'berita';
    
            $berkas->move($tujuan_upload,$nama_document);
            
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'crew' => $request->crew,
                'size_of_event' => $request->size_of_event,
                'lokasi' => $request->lokasi,
                'gambar_event' => $nama_document,
            ];
        }

        Event::where('id_event', $id_event)->update($data);

        $need_crew = $request->need_crew;
        foreach ($need_crew as $key => $value) {
            $data_crew = [
                'need_crew' => $value,
                'id_event' => $id_event,
            ];

            NeedCrew::insert($data_crew);
        }


        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }


    public function update_detail(Request $request){

        $id_event = $request->id_event;
        $id_detail_event = $request->id_detail_event;
        $id_users = $request->id_users;

        $event = Event::where('id_event', $id_event)->first();
        $users = User::where('id', $id_users)->first();
        $point_users = $users->point;
        $point = $event->crew;

        $update_users = [
            'point' => intval($point_users + $point),
        ];
        User::where('id', $id_users)->update($update_users);
        
        $data = [
            'status_kehadiran' => $request->status_kehadiran
        ]; 
        DetailEvent::where('id_detail_event', $id_detail_event)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_event){
        Event::where('id_event', $id_event)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }

    


}
