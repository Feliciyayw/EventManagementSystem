<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPengunjungController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $date = date('Y-m-d H:i:s');

        $data = [
            'title' => "Users Data",
            'pengunjung' => User::where('hak_akses', 'pengunjung')->get(),
        ];

        return view('admin/datapengunjung')->with('data', $data);
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

        return redirect()->back()->with('suc_message', 'Data has successfully updated!');
    }

    public function non_aktiv(Request $request){

        $id = $request->id;
      
            
        $data = [
            'aktiv' => $request->aktiv,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data has successfully update!');
    }

    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Deleted Successfully!');
    }

}
