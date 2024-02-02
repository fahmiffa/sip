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
use PDF;
use QrCode;
use Exception;

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
    
        if($head->status == 1)
        {
            toastr()->success('Document Complete', ['timeOut' => 5000]);
            return redirect()->route('verification.index');
        }
        $doc  = Formulir::where('name',$head->type)->first(); 
        $dis  = District::all();
        $data = 'Verifikasi '.$head->type;
        
        return view('document.verifikasi.index',compact('head','doc','data','head','dis'));    
    }

    public function modif($id)
    {

        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        $doc  = Formulir::where('name','umum')->first(); 
        $dis  = District::all();
        $data = 'Edit Verifikasi '.$head->type;
        
        return view('document.umum.edit',compact('head','doc','data','head','dis'));    
    }

    public function doc($id)
    {
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
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

    public function next(Request $request, $id)
    {                    
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        $step = Step::where(DB::raw('md5(head)'),$id)->first(); 
        $level = Auth::user()->roles->kode;
        
        $mid = [3,4];

        if($head->status == 1)
        {
            toastr()->success('Document Complete', ['timeOut' => 5000]);
            return redirect()->route('verification.index');
        }
        else if($head->status == 2)
        {
            $step->kode = $level;
            $step->save();

            $head->saran = $request->content;
            $head->status = 1;
            $head->save();

            toastr()->success('Input Complete', ['timeOut' => 5000]);
            return redirect()->route('verification.index');
        }
        else if($head->status == 5)
        {           
        
            if($request->item)
            {
                $da['item'] = $request->item;
                $da['saranItem'] = $request->saranItem;
            } 
    
            if($request->sub)
            {
                $sub = $request->sub;

                foreach ($sub as $key => $value) {
                    $subs[]= [
                                'title'=>$key,
                                'value'=>$value,
                                'saran'=>$request->saranSub                
                                ]; 
                }                
                $da['sub'] = $subs;  
            }

            $item['dokumen_administrasi'] = $da;

            $head->status = 4;
            $head->save();  

            if(!$step)
            {
                $step = new Step;
            }
            $step->head = $head->id;
            $step->item = json_encode($item);
            $step->save();
        }
        else if(in_array($head->status,$mid))
        { 

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
                $sub = $request->sub;

                foreach ($sub as $key => $value) {
                    $subs[]= [
                                'title'=>$key,
                                'value'=>$value,
                                'saran'=>$request->saranSub                
                                ]; 
                }                
                $da['sub'] = $subs;  
            }
    

            // if($request->other)
            // {
            //     $da['other'] = $request->other;
            // }
    
            // if($request->nameOther)
            // {
            //     $da['nameOther'] = $request->nameOther;
            // }
    
            // if($request->saranOther)
            // {
            //     $da['saranOther'] = $request->saranOther;
            // }
    

            $old = (array) json_decode($step->item);

            
            if($head->type == 'menara')
            {
                $item = array_merge(['persyaratan_teknis'=>$da], $old);  
                $head->status =  2;
            }
            else
            {
                if($head->status == 4)
                {     
                    $item = array_merge(['dokumen_teknis'=>$da], $old);   
                }
    
                if($head->status == 3)
                { 
                    $item = array_merge(['dokumen_pendukung_lainnya'=>$da], $old);   
                }

                $head->status =  $head->status-1;
            }
            
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

        elseif($head->status == 3)
        {
            $new = (array) json_decode($step->item);
            Arr::forget($new, 'dokumen_teknis');  
            $sub = $old->dokumen_teknis->sub;
            $saranSub = $old->dokumen_teknis->saranSub;
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

        elseif($head->status == 4)
        {  
            $item = $old->dokumen_administrasi->item;
            $saranItem = $old->dokumen_administrasi->saranItem;

            foreach ($saranItem as $key => $value) {
                $data_history['saranItem['.$key.']'] = $value;
            }   

            foreach ($item as $key => $value) {
                $data_history['item['.$key.']'] = $value;
            }   

            if(isset($old->dokumen_administrasi->sub))
            {
                $sub = $old->dokumen_administrasi->sub;
                foreach ($sub as $key => $value) {
                    $data_history['sub['.$key.']'] = $value;
                }   
            }
            
            if(isset($old->dokumen_administrasi->saranSub))
            {
                $saranSub = $old->dokumen_administrasi->saranSub;
                foreach ($saranSub as $key => $value) {
                    $data_history['saranSub['.$key.']'] = $value;
                }   
            }


            $step->delete();

            
            $head->status = 5;
            $head->save();
        }

        return back()->withInput($data_history);   
        // return redirect()->route('verifikasi.create')->withInput($data_history);   
    }

    public function nexts(Request $request, $id)
    {                    
        $head  = Head::where(DB::raw('md5(id)'),$id)->first();    
        $step  = Step::where(DB::raw('md5(head)'),$id)->first(); 
        $level = Auth::user()->roles->kode;
        
        // if(!$step)
        // {
        // }
        
        $step = new Step;

        if($level == 'VL3')
        {      
            if($request->item)
            {
                $da['item'] = $request->item;
                $da['saranItem'] = $request->saranItem;
            } 
    
            if($request->sub)
            {
                $sub = $request->sub;

                foreach ($sub as $key => $value) {
                    $subs[]= [
                                'title'=>$key,
                                'value'=>$value,
                                'saran'=>$request->saranSub                
                                ]; 
                }                
                $da['sub'] = $subs;  
            }

            $item['dokumen_administrasi'] = $da;

            $step->head = $head->id;
            $step->item = json_encode($item);
            $step->kode = $level;
            $step->save();

            if($head->status == 5)
            {                
                $head->status = $head->status - 1;
            }
            else
            {
                $head->status = 1;
            }

            $head->save();

            toastr()->success('Input Complete', ['timeOut' => 5000]);
            return redirect()->route('verification.index');
        }
        elseif($level == 'VL2')
        {

            if($request->sub)
            {
                $sub = $request->sub;

                foreach ($sub as $key => $value) {
                    $subs[]= [
                                'title'=>$key,
                                'value'=>$value,
                                'saran'=>$request->saranSub                
                                ]; 
                }                
                $da['sub'] = $subs;  
            }

            $item = ['dokumen_teknis'=>$da];

            $step->head = $head->id;
            $step->kode = $level;
            $step->item = json_encode($item);
            $step->save();

            if($head->status == 5)
            {                
                $head->status = $head->status - 1;
            }
            else
            {
                $head->status = 1;
            }

            $head->save();

            toastr()->success('Input Complete', ['timeOut' => 5000]);
            return redirect()->route('verification.index');
        }
        else 
        {
            toastr()->error('Input Gagal, Next', ['timeOut' => 5000]);
            return back();
        }
             
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
