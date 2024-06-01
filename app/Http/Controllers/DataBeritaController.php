<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Informasi;

use App\Models\Berita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataBeritaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Berita",
            'informasi' => Informasi::join('users', 'users.id', '=', 'informasi.id_users')->get(),
            // 'materi' => VwInformasi::get('id_users', $id_users)->get(),
        ];
    

        return view('admin/databerita')->with('data', $data);
    }

   
    public function insert(Request $request){

        $berkas = $request->file('gambar_informasi');
        $nama_document = time()."_".$berkas->getClientOriginalName();
        $tujuan_upload = 'berita';

        $berkas->move($tujuan_upload,$nama_document);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'id_users' => Auth::user()->id,
            'gambar_informasi' => $nama_document,
            'created_at' => Carbon::now(),
        ];


        Informasi::insert($data);

        return redirect()->back()->with('suc_message', 'Data saved successfully!');
    }

    public function update(Request $request){

        $id_informasi = $request->id_informasi;
        $berkas = $request->file('gambar_informasi');
        if($berkas == NULL){
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];
    
        }else{
            $nama_document = time()."_".$berkas->getClientOriginalName();
            $tujuan_upload = 'berita';
    
            $berkas->move($tujuan_upload,$nama_document);
            
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar_informasi' => $nama_document,
            ];
        }

        Informasi::where('id_informasi', $id_informasi)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_informasi){
        Informasi::where('id_informasi', $id_informasi)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }

    


}
