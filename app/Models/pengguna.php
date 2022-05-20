<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengguna extends Model
{
    public function addPengguna($data){
        DB::table('pengguna')->insert($data);
    }

    public function addBalas($data){
        DB::table('balas')->insert($data);
    }

    public function addPesan($data){
        DB::table('pesan')->insert($data);
    }

    public function Pengguna(){
        return DB::table('pengguna')
        ->orderBy('id_pengguna','desc')
        ->get();
    }

    public function SearchDB($request){
        return DB::table('pengguna')
        ->where('nama', 'LIKE', '%'.$request->cari.'%')
        ->orderBy('id_pengguna','desc')
        ->get();
    }

    public function allKomentar(){
        return DB::table('pesan')
        ->orderBy('id_pesan','desc')
        ->get();
    }

    public function allBalas(){
        return DB::table('balas')
        ->orderBy('pesan','desc')
        ->get();
    }

    public function detailPengguna($number){
        return DB::table('pengguna')->where('number', $number)->first();
    }
}
