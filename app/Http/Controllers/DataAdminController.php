<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webiner;
use App\Models\Materi;
use App\Models\Kategori;
use App\Models\Institusi;
use App\Models\VwWebiner;
use App\Models\VwMateri;
use App\Models\VwWebinerMateri;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Admin Data",
            'users' => User::where('hak_akses', 'admin')->get(),
        ];

        return view('admin/dataadmin')->with('data', $data);
    }



    public function insert(Request $request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'hak_akses' => 'admin',
            'aktiv' => '1',
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ];


        User::insert($data);

        return redirect()->back()->with('suc_message', 'Data saved successfully!');
    }

    public function update(Request $request){

        $id = $request->id;
      
            
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function non_aktiv(Request $request){

        $id = $request->id;
      
            
        $data = [
            'aktiv' => $request->aktiv,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }


}
