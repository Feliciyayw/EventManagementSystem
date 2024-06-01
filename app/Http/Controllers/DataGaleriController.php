<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Informasi;

use App\Models\Galeri;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataGaleriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Galeri",
            'galeri' => Galeri::get(),
            // 'materi' => VwGaleri::get('id_users', $id_users)->get(),
        ];
    

        return view('admin/datagaleri')->with('data', $data);
    }

   
    public function insert(Request $request){

        $berkas = $request->file('gambar');
        $nama_document = time()."_".$berkas->getClientOriginalName();
        $tujuan_upload = 'galeri';

        $berkas->move($tujuan_upload,$nama_document);

        $data = [
            'gambar' => $nama_document,
            'created_at' => Carbon::now(),
        ];


        Galeri::insert($data);

        return redirect()->back()->with('suc_message', 'Data saved successfully!');
    }

    public function update(Request $request){

        $id_galeri = $request->id_galeri;
        $berkas = $request->file('gambar');
    
        $nama_document = time()."_".$berkas->getClientOriginalName();
        $tujuan_upload = 'galeri';

        $berkas->move($tujuan_upload,$nama_document);
        
        $data = [
            'gambar' => $nama_document,
        ];
    

        Galeri::where('id_galeri', $id_galeri)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_galeri){
        Galeri::where('id_galeri', $id_galeri)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }

    


}
