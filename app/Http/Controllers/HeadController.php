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
use PDF;
use QrCode;
use Exception;

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
        $da = verifikasi::withTrashed()->latest()->get();
        $data = "Verifikasi";
        return view('document.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "Tambah Verifikasi";
        $dis  = District::all();
        $user = Role::whereIn('kode',['VL1', 'VL2', 'VL3'])->get(); 
        return view('document.create',compact('data','user','dis'));
    }

    public function doc($id)
    {
        $head = Verifikasi::where(DB::raw('md5(id)'),$id)->first(); 
        $docs  = Formulir::where('name',$head->type)->first(); 

        // dd($doc);

        $step = $head->step == 1 ? 0 : 1;
        
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($head->nomor));
        $data = compact('qrCode','docs','head','step');

        if($head->step == 1)
        {
            $pdf = PDF::loadView('verifikator.doc.index', $data)->setPaper('a4', 'potrait');    
            return $pdf->stream();
            return view('verifikator.doc.index',$data);    
        }
        else
        {
            $pdf = PDF::loadView('verifikator.doc.home', $data)->setPaper('a4', 'potrait');    
            return $pdf->stream();
            return view('verifikator.doc.home',$data);    
        }
    }

    public function approve(Request $request, $id)
    {
        $head = Verifikasi::where(DB::raw('md5(id)'),$id)->first();   
        $head->grant = 1;
        $head->save();
        toastr()->success('Verifikasi Data berhasil', ['timeOut' => 5000]);
        return back();                
    }


    public function reject(Request $request, $id)
    {
        $old = Verifikasi::where(DB::raw('md5(id)'),$id)->first(); 
        $old->note = $request->note;       
        $old->save(); 
        
        $head = new Verifikasi;
        $head->parent = $old->id;
        $head->village = $old->village;
        $head->header = $old->header;
        $head->nomor = $old->nomor;
        $head->type = $old->type;
        $head->status = 5;
        $head->verifikator = $old->verifikator;
        $head->step = $old->step;
        $head->sekretariat = Auth::user()->id;
        $head->save();

        $old->delete();

        toastr()->success('Verifikasi Data berhasil', ['timeOut' => 5000]);
        return back();     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'name' => 'required',           
            'type'=> 'required',
            'verifikator'=>'required',
            'namaPemohon' => 'required',           
            'alamatPemohon'=> 'required',                                    
            'namaBangunan'=> 'required',                                    
            'alamatBangunan'=> 'required', 
            'pengajuan'=> 'required', 
            'fungsi'=> 'required', 
            'noreg'=> 'required', 
            'dis'=> 'required', 
            'des'=> 'required', 
            'hp'=> 'required',                                           
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        // validasi tahap
        if(count($request->verifikator) > 2)
        {
            toastr()->error('Verifikator maksimal 2', ['timeOut' => 5000]);
            return back();
        }

        $header= [$request->noreg, $request->pengajuan, $request->namaPemohon, $request->hp, $request->alamatPemohon, $request->namaBangunan, $request->fungsi, $request->alamatBangunan];                

        $head = new Verifikasi;
        $head->village = $request->des;
        $head->header = json_encode($header);
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

    public function village(Request $request)
    {
        $da = Village::where('districts_id',$request->id)->pluck('name', 'id');
        return response()->json($da);
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
        $dis  = District::all();

        $data = "Edit Verifikasi";
        return view('document.create',compact('data','verifikasi','user','dis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        $rule = [                   
            'name' => 'required',           
            'type'=> 'required',
            'verifikator'=>'required',
            'namaPemohon' => 'required',           
            'alamatPemohon'=> 'required',                                    
            'namaBangunan'=> 'required',                                    
            'alamatBangunan'=> 'required', 
            'pengajuan'=> 'required', 
            'fungsi'=> 'required', 
            'noreg'=> 'required', 
            'dis'=> 'required', 
            'des'=> 'required', 
            'hp'=> 'required',                                           
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        $header= [$request->noreg, $request->pengajuan, $request->namaPemohon, $request->hp, $request->alamatPemohon, $request->namaBangunan, $request->fungsi, $request->alamatBangunan];                
        $head->village = $request->des;
        $head->header = json_encode($header);
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
