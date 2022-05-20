<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengguna;
use Illuminate\Support\Str;

class penggunaController extends Controller
{
    public function __construct(){
        $this->pengguna = new pengguna;
    }

    public function index(){
        return view('home');
    }

    public function add(){
        return view('add');
    }

    public function save(){
        request()->validate([
            'nama' => 'required|unique:pengguna,nama',
        ],[
            'nama.required' => 'Nama Harap diisi',
            'nama.unique' => 'Nama Sudah Ada',
        ]);

        $rndm = Str::random(5);

        $data = [
            'nama' => request()->nama,
            'pesan' => "kosong",
            'tanggal' => Date('Y-m-d'),
            'number' => $rndm,
        ];

        $this->pengguna->addPengguna($data);

        return redirect()->to('/'.$rndm);

    }

    public function about(){
        return view('about');
    }

    public function message($number){
        $data = [
            'show' => $this->pengguna->detailPengguna($number),
            'alldb' => $this->pengguna->allKomentar(),
            'balas' => $this->pengguna->allBalas(),
        ];
        return view('message',$data);
    }

    public function savemessage(){
        request()->validate([
            'pesan' => 'required',
        ],[
            'pesan.required' => 'Pesan Harap diisi',
        ]);

        $data = [
            'pesan' => request()->pesan,
            'id_number' => request()->number,
            'tanggal' => Date('Y-m-d h:i:s'),
        ];

        $this->pengguna->addPesan($data);

        $number = request()->number;

        return redirect()->to('/'.$number)->with('complete','complete');
    }

    public function balasmessage(){
        request()->validate([
            'balas' => 'required',
        ],[
            'balas.required' => 'Pesan Harap diisi',
        ]);

        $data = [
            'no_user' => Request()->number,
            'id_pesan' => Request()->id_pesan,
            'pesan' => Request()->balas,
        ]; 

        $this->pengguna->addBalas($data);

        $number = Request()->number;

        return redirect()->to('/'.$number);
    }

    public function search(Request $request){

        if($request->has('cari')){
            $data = [
                'showpengguna' => $this->pengguna->SearchDB($request),
            ];
        }else{
            $data = [
                'showpengguna' => $this->pengguna->Pengguna(),
            ];
        }

        return view('search',$data);
    }
}

