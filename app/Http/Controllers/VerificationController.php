<?php

namespace App\Http\Controllers;

use App\Models\Verification;
use Illuminate\Http\Request;
use App\Models\Head;
use Auth;
use DB;
use App\Models\Formulir;
use App\Models\Village;
use App\Models\Role;
use App\Models\District;
use App\Models\Step;
use Illuminate\Support\Arr;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:doc_formulir');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $da = Head::all();      
        // $da = Head::where('status',5)->get();      
        $data = "Dokumen";
        return view('verifikator.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doc = Head::all();
        $data = "Tambah Formulir";
        return view('document.verifikasi.create',compact('data','doc'));
    }


    public function step($id)
    {
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        $doc  = Formulir::where('name','umum')->first(); 
        $dis  = District::all();
        $data = 'Verifikasi '.$head->type;
        
        return view('document.umum',compact('head','doc','data','head','dis'));    
    }

    public function next(Request $request, $id)
    {                    
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        
        $mid = [3,4];
        if($head->status == 5)
        {
            $rule = [                   
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
          
            if($request->item)
            {
                $da['item'] = $request->item;
            }
    
            if($request->saranItem)
            {
                $da['saranItem'] = $request->saranItem;
            }
    
            if($request->sub)
            {
                $da['sub'] = $request->sub;
            }
    
            if($request->saranSub)
            {
                $da['saranSub'] = $request->saranSub;
            }
    
            if($request->other)
            {
                $da['other'] = $request->other;
            }
    
            if($request->nameOther)
            {
                $da['nameOther'] = $request->nameOther;
            }
    
            if($request->saranOther)
            {
                $da['saranOther'] = $request->saranOther;
            }
    
            $item['dokumen_administrasi'] = $da;

            $head->status = 4;
            $head->village = $request->village;
            $head->save();  

            $step = new Step;
            $step->head = $head->id;
            $step->header = json_encode($header);
            $step->item = json_encode($item);
            $step->save();
        }
        elseif(in_array($head->status,$mid))
        {

            $step = Step::where(DB::raw('md5(head)'),$id)->first();   

            if($request->item)
            {
                $da['item'] = $request->item;
            }
    
            if($request->saranItem)
            {
                $da['saranItem'] = $request->saranItem;
            }
    
            if($request->sub)
            {
                $da['sub'] = $request->sub;
            }
    
            if($request->saranSub)
            {
                $da['saranSub'] = $request->saranSub;
            }
    
            if($request->other)
            {
                $da['other'] = $request->other;
            }
    
            if($request->nameOther)
            {
                $da['nameOther'] = $request->nameOther;
            }
    
            if($request->saranOther)
            {
                $da['saranOther'] = $request->saranOther;
            }
    

            $old = (array) json_decode($step->item);

            if($head->status == 4)
            {     
                $item = array_merge(['dokumen_teknis'=>$da], $old);   
            }

            if($head->status == 3)
            { 
                $item = array_merge(['dokumen_pendukung_lainnya'=>$da], $old);   
            }

            $head->status =  $head->status-1;
            $head->save(); 

            $step->item = json_encode($item);
            $step->save();
        }
        else
        {
            toastr()->error('Input Gagal, Next', ['timeOut' => 5000]);
            return back();
        }


        toastr()->success('Input berhasil, Next', ['timeOut' => 5000]);
        return back();

    }

    public function back(Request $request, $id)
    {
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        $step = Step::where(DB::raw('md5(head)'),$id)->first();   

        $old = json_decode($step->item);
        
        if($head->status == 2)
        {
            $new = (array) json_decode($step->item);
            Arr::forget($new, 'dokumen_pendukung_lainnya');
            $item = $old->dokumen_pendukung_lainnya->item;
            $saranItem = $old->dokumen_pendukung_lainnya->saranItem;
            $sub = $old->dokumen_pendukung_lainnya->sub;
            $saranSub = $old->dokumen_pendukung_lainnya->saranSub;

            foreach ($saranItem as $key => $value) {
                $data_history['saranItem['.$key.']'] = $value;
            }   

            foreach ($item as $key => $value) {
                $data_history['item['.$key.']'] = $value;
            }   

            foreach ($sub as $key => $value) {
                $data_history['sub['.$key.']'] = $value;
            }   

            foreach ($saranSub as $key => $value) {
                $data_history['saranSub['.$key.']'] = $value;
            }   

            $step->item = json_encode($new);
            $step->save();

            
            $head->status = 3;
            $head->save();

            // dd($data_history);
        }

        if($head->status == 3)
        {
            $new = (array) json_decode($step->item);
            Arr::forget($new, 'dokumen_teknis');
            // $item = $old->dokumen_teknis->item;
            // $saranItem = $old->dokumen_teknis->saranItem;
            $sub = $old->dokumen_teknis->sub;
            $saranSub = $old->dokumen_teknis->saranSub;

            // foreach ($saranItem as $key => $value) {
            //     $data_history['saranItem['.$key.']'] = $value;
            // }   

            // foreach ($item as $key => $value) {
            //     $data_history['item['.$key.']'] = $value;
            // }   

            foreach ($sub as $key => $value) {
                $data_history['sub['.$key.']'] = $value;
            }   

            foreach ($saranSub as $key => $value) {
                $data_history['saranSub['.$key.']'] = $value;
            }   

            $step->item = json_encode($new);
            $step->save();

            
            $head->status = 4;
            $head->save();
        }

        if($head->status == 4)
        {  
            $item = $old->dokumen_administrasi->item;
            $saranItem = $old->dokumen_administrasi->saranItem;
            $sub = $old->dokumen_administrasi->sub;
            $saranSub = $old->dokumen_administrasi->saranSub;

            foreach ($saranItem as $key => $value) {
                $data_history['saranItem['.$key.']'] = $value;
            }   

            foreach ($item as $key => $value) {
                $data_history['item['.$key.']'] = $value;
            }   

            foreach ($sub as $key => $value) {
                $data_history['sub['.$key.']'] = $value;
            }   

            foreach ($saranSub as $key => $value) {
                $data_history['saranSub['.$key.']'] = $value;
            }   

            $step->delete();

            
            $head->status = 5;
            $head->save();
        }

        if($head->status == 5)
        {
            $data_history = [
                'name'=>$head->name,
                'jenis'=>$head->jenis,      
            ];
        }


        // $head->status = 5;
        // $head->save();

        // $head->delete();

        return back()->withInput($data_history);   
        // return redirect()->route('verifikasi.create')->withInput($data_history);   
    }

    public function village(Request $request)
    {
        $da = Village::where('districts_id',$request->id)->pluck('name', 'id');
        return response()->json($da);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Verification $verification)
    {
        dd($verification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verification $verification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verification $verification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verification $verification)
    {
        //
    }
}
