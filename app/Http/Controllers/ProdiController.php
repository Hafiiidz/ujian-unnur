<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use DB;

class ProdiController extends Controller
{
    public function index(){

        $paket_soal = DB::table('tbl_kategori_soal')
                    ->join('tbl_paket_soal','tbl_kategori_soal.id_kategori_soal','=','tbl_paket_soal.id_kategori_soal')
                    ->get();

        return view ('prodi.filter-soal.index', compact('paket_soal'));
    }

    public function tampil_filter($id){

        $id_soal = $id;

        $nama_soal = DB::table('tbl_paket_soal')
                    ->select('nama_paket_soal')
                    ->where('id_paket_soal', $id_soal)
                    ->first();
        $data_mhs = DB::table('users')
                    ->where('status','mhs')
                    ->get();            

        return view ('prodi.filter-soal.filter', compact('nama_soal','data_mhs','id_soal')); 
    }

    public function get_filter(Request $request){
        //dump($request->pilihan);
        if(!empty($request->pilihan)){
            $data_pil = $request->pilihan;
            $jumlah = count($request->pilihan);
            for($i = 0; $i < $jumlah; $i++){

                $pilihan_nim = $data_pil[$i];

                DB::table('tbl_filter_kelas')->insert([
                    'id_paket_soal' => $request->id_paket,
                    'nim_mhs' => $pilihan_nim,
                    'status' => 1
                ]);
                //dump($pilihan_nim);
                // DB::table('users')->where('username', $pilihan_nim)->update([
                //     'status_ujian' => 1
                // ]);

            }

            return redirect('prodi/filter-soal');
        }else{
            return back();
        }
        

    }

    public function update_status($username , $id_soal){

        // DB::table('users')->where('username', $id)->update([
        //     'status_ujian' => 0
        // ]);

        // DB::table('tbl_filter_kelas')->where('nim_mhs',$id)->delete();
        DB::table('tbl_filter_kelas')->where([
            ['nim_mhs',$username],
            ['id_paket_soal', $id_soal]
            ])->delete();

        return back();
    }

    public function get_filter_nim(Request $request){

    }
}
