<?php

namespace App\Http\Controllers;

use App\Models\Head as Verifikasi;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Formulir;
use App\Models\Village;
use App\Models\Role;
use App\Models\District;

class HeadController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsPermission:master_formulir');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = verifikasi::all();
        $data = "Verifikasi";
        return view('document.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "Tambah Verifikasi";
        $user = Role::whereIn('kode',['VL1', 'VL2', 'VL3'])->get(); 
        return view('document.create',compact('data','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'name' => 'required',           
            'type'=> 'required',
            'verifikator'=>'required'                                    
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        $head = new Verifikasi;
        $head->nomor = $request->name;
        $head->type = $request->type;
        $head->status = 5;
        $head->verifikator = implode(",",$request->verifikator);
        $head->step = count($request->verifikator);
        $head->sekretariat = Auth::user()->id;
        $head->save();

        toastr()->success('Tambah Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('verifikasi.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verifikasi $verifikasi)
    {
        $user = Role::whereIn('kode',['VL1', 'VL2', 'VL3'])->get(); 

        $data = "Edit Verifikasi";
        return view('document.create',compact('data','verifikasi','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        $rule = [                   
                'name'        => 'required',           
                'type'        => 'required',
                'verifikator' => 'required'                                    
            ];

        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        $verifikasi->nomor = $request->name;
        $verifikasi->type = $request->type;
        $verifikasi->verifikator = implode(",",$request->verifikator);
        $verifikasi->step = count($request->verifikator);
        $verifikasi->save();

        toastr()->success('Update Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('verifikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verifikasi $verifikasi)
    {
        $verifikasi->delete();
        toastr()->success('Delete Data berhasil', ['timeOut' => 5000]);
        return back();
    }
}
