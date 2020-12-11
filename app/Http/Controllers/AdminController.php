<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use DB;

class AdminController extends Controller
{
    public function index_user(){

        $data_user = DB::table('users')->get();

        return view('admin.user.index', compact('data_user'));
    }

    public function simpan_user(Request $request){
        $this->validate($request, [
            'username' =>['required','unique:users'],
        ]);

        DB::table('users')->insert([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'id_prodi' => $request->prodi,
            'status' => $request->status
        ]);

        $user = DB::select("select id from users where username ='".$request->username."'");
        $sorted_user = Arr::get($user,0);
        $sortedd_user = Arr::flatten($sorted_user);
        $user_id = Arr::get($sortedd_user,0);

        if($request->status == "dosen"){
            DB::table('role_user')->insert([
                'role_id' => "2",
                'user_id' => $user_id,
            ]);
        }else{
            DB::table('role_user')->insert([
                'role_id' => "3",
                'user_id' => $user_id,
            ]);
        }

        return redirect('/admin/user');

    }

    public function ubah_user(Request $request){

        if(empty($request->password)){
            DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'id_prodi' => $request->prodi,
                'status' => $request->status
            ]);
        }else{
            DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request->password),
                'id_prodi' => $request->prodi,
                'status' => $request->status
            ]);
        }

        $user = DB::select("select id from users where username ='".$request->username."'");
        $sorted_user = Arr::get($user,0);
        $sortedd_user = Arr::flatten($sorted_user);
        $user_id = Arr::get($sortedd_user,0);

        if($request->status == "dosen"){
            DB::table('role_user')
            ->where('user_id', $user_id)
            ->update([
                'role_id' => "2",
            ]);
        }else{
            DB::table('role_user')
            ->where('user_id', $user_id)
            ->update([
                'role_id' => "3",
            ]);
        }

        return redirect('/admin/user');


    }

    public function hapus_user($id){
        DB::table('users')
        ->where('id', $id)
        ->delete();

        DB::table('role_user')
        ->where('user_id', $id)
        ->delete();

        return redirect('/admin/user');
    }

    public function get_user(Request $request){
        $data = DB::table('users')->where('id', $request->id)->first();

        return response()->json($data);
    }

    
}
