<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    public function index(){

        $user = $this->cek_user(Auth::user()->id);


        $cek_status_form_nilai = DB::table('tbl_pengaturan')->first();
        $data_nilai_mhs = DB::table('tbl_kategori_soal')
                    ->join('tbl_paket_soal','tbl_kategori_soal.id_kategori_soal','=','tbl_paket_soal.id_kategori_soal')
                    ->join('tbl_nilai','tbl_paket_soal.id_paket_soal','=','tbl_nilai.id_paket_soal')
                    ->where('tbl_nilai.id_mhs', Auth::user()->id)
                    ->get();

        return view('dashboard.index', compact('data_nilai_mhs','user','cek_status_form_nilai'));
    }

    public function cek_user($id){
        $data_user = DB::table('roles')
                    ->select('roles.name')
                    ->join('role_user','roles.id','=','role_user.role_id')
                    ->join('users','role_user.user_id','=','users.id')
                    ->where('users.id',$id)
                    ->first();

        return $data_user;
    }

    public function changepassword(Request $request,$id){
        $user = User::findOrFail($id);
        if ($request->password != $request->pas_confr || md5($request->pas_lama) != Auth::user()->password) {
            return redirect()->back()->with('error','Password Yang Anda Masukan Tidak Sama');
        } else {
            $password = !empty($request->password) ? md5($request->password):$user->password;
            $user->update([
                'password'=>$password
                ]);
            return redirect('/logout');
        }
    }
}
