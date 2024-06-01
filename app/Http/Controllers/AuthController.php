<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\VwInstitusi;
use App\Models\Kategori;
use App\Models\Institusi;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class AuthController extends Controller
{

    
    public function register()
    {
        $data = [
            // 'kategori' => Kategori::get(),
        ];
        return view('auth.register', $data);
    }

    public function register_institusi()
    {
        return view('auth.register-institusi');
    }

    public function insert_register(Request $request)
    {
        $berkas_cv = $request->file('cv');
        $nama_document_cv = time()."_".$berkas_cv->getClientOriginalName();
        $tujuan_upload = 'cv';

        $berkas_cv->move($tujuan_upload,$nama_document_cv);

        $berkas_gambar = $request->file('gambar');
        $nama_document_gambar = time()."_".$berkas_gambar->getClientOriginalName();
        $tujuan_upload = 'profile';

        $berkas_gambar->move($tujuan_upload,$nama_document_gambar);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'hak_akses' => 'pengunjung',
            'aktiv' => '0',
            'alamat' => $request->alamat,
            'cv' => $nama_document_cv,
            'gambar' => $nama_document_gambar,
        ];


        $user = User::create($data);
        $lastId = $user->id;

        $email = $request->email;
        $data_email = [
            'title' => 'Verify your email account by clicking the button below',
            'url' => 'http://localhost/aplikasi_event_organizer/public/verifikasi/'.$lastId,
        ];

        Mail::to($email)->send(new SendMail($data_email));
        

        return redirect('login')->with('suc_message', 'Please Check Your Email to Verify!');
    }


    public function login()
    {
        return view('auth.login');
    }


    public function action_login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();

            if(Auth::user()->hak_akses == 'users'){
                if(Auth::user()->aktiv == 0 || Auth::user()->aktiv == 0){
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->back()->with('err_message', 'Account need to be verified !!');
                    return redirect('login');
                }else{
                    
                    return redirect('');
                }
            }else if(Auth::user()->hak_akses == 'pengunjung'){
                if(Auth::user()->aktiv == 0 || Auth::user()->aktiv == 0){
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->back()->with('err_message', 'Account Disabled !!');
                    return redirect('login');
                }else{
                    
                    return redirect('');
                }
            }else{
                if(Auth::user()->aktiv == 0 || Auth::user()->aktiv == 0){
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->back()->with('err_message', 'Account Disabled !!');
                    return redirect('login');
                }else{
                    
                    return redirect('dashboard-admin');
                }
            }   
        }

        return redirect()->back()->with('err_message', 'Wrong email or password !!');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        $id_users = Auth::user()->id;

        $data = [
            'title' => "Data Profile",
            'profile' => User::where('id', $id_users)->first(),
        ];

        return view('auth/profile')->with('data', $data);
    }


    public function profile_users()
    {
        $id_users = Auth::user()->id;

        $data = [
            'title' => "Data Profile",
            'detail' => User::where('id', $id_users)->first(),
        ];

        return view('auth/profileusers')->with('data', $data);
    }

    public function update_profile(Request $request){

        $id_users = $request->id_users;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
        ];
        User::where('id', $id_users)->update($data);

        return redirect()->back()->with('suc_message', 'Data saved successfully!');
    }


    

    public function update_lengkapi_insititusi(Request $request){
        $id_users = Auth::user()->id;

        $data = [
            'nama_institusi' => $request->nama_institusi,
            'email_institusi' => $request->email_institusi,
            'tgl_berdiri' => $request->tgl_berdiri,
            'phone_number_institusi' => $request->phone_number_institusi,
            'id_users' => $id_users,
            'created_at' => Carbon::now(),
        ];

        Institusi::insert($data);

        return redirect('dashboard-institusi')->with('suc_message', 'Data saved successfully!');
    }

}
