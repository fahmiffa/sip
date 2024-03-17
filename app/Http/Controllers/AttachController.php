<?php

namespace App\Http\Controllers;

use App\Models\Attach;
use Illuminate\Http\Request;
use App\Models\Meet;
use App\Models\Head;
use App\Models\Tax;
use DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Auth;
use QrCode;
use Exception;

class AttachController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:bak');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)  
    {
         $val = Head::whereHas('barp',function($q){
             $q->where('grant',1);
         })->latest();            
         $da = $val->paginate(10);
 
         $data = "Lampiran";  
         $ver = false;        
         return view('document.attach.home',compact('da','data','ver'));   

    }

    public function doc($id)
    {
        $head = Head::where(DB::raw('md5(id)'),$id)->first();            
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($head->nomor));
        $data = compact('qrCode','head');

        $pdf = PDF::loadView('document.attach.doc.index', $data)->setPaper('a4', 'potrait');    
        return $pdf->stream();   
    }

    public function docs($id)
    {
        $head = Head::where(DB::raw('md5(id)'),$id)->first();            
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($head->nomor));
        $data = compact('qrCode','head');

        $pdf = PDF::loadView('document.tax.doc.index', $data)->setPaper('a4', 'potrait');    
        return $pdf->stream();   
    }

    public function step($id)
    {
        $attach = Attach::where(DB::raw('md5(head)'),$id)->first();   
        if($attach)
        {
            toastr()->error('Invalid Data', ['timeOut' => 5000]);
            return back();
        }
        else
        {
            $head = Head::where(DB::raw('md5(id)'),$id)->first(); 

            $data = "Dokumen ".$head->number;
            return view('document.attach.create',compact('data','head'));
        }

    }

    public function tax(Request $request)  
    {
         $val = Head::has('attach')->latest();            
         $da = $val->paginate(10);
 
         $data = "Perhitungan Retribusi";  
         $ver = false;        
         return view('document.tax.home',compact('da','data','ver'));   

    }

    public function stepr($id)
    {
        $tax = Tax::where(DB::raw('md5(head)'),$id)->first();   
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        $data = "Dokumen ".$head->number;
        return view('document.tax.step',compact('data','head','tax'));

    }

    public function storeTax(Request $request, $id)
    {


        $tax = Tax::where(DB::raw('md5(head)'),$id)->first();   
        $head = Head::where(DB::raw('md5(id)'),$id)->first(); 
        if($tax)
        {

            $bg  = $request->bg;
            $bgv = $request->bgv;
            foreach ($bg as $key => $value) {
                $bag[] = ['uraian'=>$value, 'luas'=>$bgv[$key]];
            }

            $tax->gedung = json_encode($bag); 

            $rp  = $request->rp;
            $vol = $request->vol;
            $sat = $request->sat;
            $price = $request->price;
            $jml = $request->jml;
            
            foreach ($rp as $key => $value) {
                $pra[] = ['uraian'=>$value, 'volume'=>$vol[$key], 'satuan'=>$sat[$key], 'harga'=>$price[$key], 'jumlah'=>$jml[$key]];
            }
            $tax->prasarana = json_encode($pra); 
            $tax->status = 1;
            $tax->save();

            toastr()->success('Input Data berhasil', ['timeOut' => 5000]);
            return redirect()->route('tax.index');
        }
        else
        {
            $rule = [                   
                'tanggal'       => 'required',                                                                                                                          
                ];
            $message = ['required'=>'Field ini harus diisi'];
            $request->validate($rule,$message);

            $par = $request->par;
            $index = $request->index;

            $item = new Tax;
            $item->head = $head->id;
            $item->tanggal = $request->tanggal;
            $item->parameter = json_encode(['par'=>$par, 'index'=>$index]);
            $item->status = 2;
            $item->save();

            toastr()->success('Input Data berhasil', ['timeOut' => 5000]);
            return back();
        }

        // $item = new Attach;
        // $item->head = $request->doc;
        // $item->bukti = $request->bukti;
        // $pile = $request->file('pile'); 
        // if($pile)
        // {
        //     $ext = $pile->getClientOriginalExtension();
        //     $path = $pile->storeAs(
        //         'assets/data/pile.'.$ext, ['disk' => 'public']
        //     );    
        //     $item->gambar = $path;
        // }  
        // $item->lahan = $request->lahan;
        // $item->lokasi = $request->lokasi;
        // $item->luas = $request->luas;
        // $item->koordinat = $request->koordinat;
        // $item->save();

        // toastr()->success('Input Data berhasil', ['timeOut' => 5000]);
        // return redirect()->route('attach.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'doc'       => 'required',  
            'luas'      => 'required',                                                          
            'bukti'       => 'required',                                                                                                                        
            'lahan'       => 'required',                                                                                                                        
            'lokasi'       => 'required',                                                                                                                        
            'koordinat'       => 'required',     
            'pile'       => 'required',                                                                                                                        
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        $item = new Attach;
        $item->head = $request->doc;
        $item->bukti = $request->bukti;
        $pile = $request->file('pile'); 
        if($pile)
        {
            $ext = $pile->getClientOriginalExtension();
            $path = $pile->storeAs(
                'assets/data/pile.'.$ext, ['disk' => 'public']
            );    
            $item->gambar = $path;
        }  
        $item->lahan = $request->lahan;
        $item->lokasi = $request->lokasi;
        $item->luas = $request->luas;
        $item->koordinat = $request->koordinat;
        $item->save();

        toastr()->success('Input Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('attach.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attach $attach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attach $attach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attach $attach)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attach $attach)
    {
        //
    }
}
