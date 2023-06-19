<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\nasabah;

class nasabahController extends Controller
{
    //mengambil dan mengirim data nasabah untuk paginate
    public function index(){
        $nasabah = nasabah::paginate(10);
        return view('nasabah', ['nasabah' => $nasabah]);
    }

    public function tambah(){
        return view('nasabah_tambah');
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'nama' => 'required',
    		'alamat' => 'required'
    	]);
 
        nasabah::create([
    		'nama' => $request->nama,
    		'alamat' => $request->alamat
    	]);
 
    	return redirect('/nasabah');
    }

    public function edit($id){
        $nasabah = nasabah::find($id);
        return view('nasabah_edit', ['nasabah' => $nasabah]);
    }

    public function update($id, Request $request){
        $this->validate($request,[
	        'nama' => 'required',
	        'alamat' => 'required'
        ]);
 
        $nasabah = nasabah::find($id);
        $nasabah->nama = $request->nama;
        $nasabah->alamat = $request->alamat;
        $nasabah->save();
        return redirect('/nasabah');
    }

    public function delete($id){
        $nasabah = nasabah::find($id);
        $nasabah->delete();
        return redirect()->back();
    }
}
