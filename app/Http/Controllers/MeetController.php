<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Head;
use DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Auth;

class MeetController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:baarp');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meet = Meet::whereNot('status',1)->first(); 

        if($meet)
        {
            return redirect()->route('step.meet',['id'=>md5($meet->head)]);
        }
        else
        {    
            $val = Head::whereHas('bak',function($q){$q->where('grant',1);})->whereHas('notulen',function($q){
                $q->where('users',Auth::user()->id);
            })->latest();            
            $da = $val->paginate(10);
    
            $data = "Berita Acara Rapat Pleno";  
            $ver = false;        
            return view('document.barp.home',compact('da','data','ver'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meet = meet::whereNot('status',1)->first(); 
        if($meet)
        {
            return redirect()->route('step.meet',['id'=>md5($meet->id)]);
        }
        else
        {
            $doc  = head::has('surat')->doesnthave('barp')->whereHas('bak',function($q){
                $q->where('grant',1);
            })->latest()->get();
            $data = "Tambah BARP";
            return view('document.barp.create',compact('data','doc'));
        }     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'doc'       => 'required',  
            'jenis'      => 'required',                                                          
            'status'       => 'required',   
            'fungsi'       => 'required',                                                          
            'nib'       => 'required',    
            'date'=>'required'                                                                                                                   
            ];
        
            
            $message = ['required'=>'Field ini harus diisi'];
            $request->validate($rule,$message);
            $header = [
                'nib'=>$request->nib,
                'jenis'=>$request->jenis,
                'status'=>$request->status,
                'fungsi'=>$request->fungsi,
              ];

            $item = new Meet;
            $item->head = $request->doc;  
            $item->tanggal = $request->date;  
            $item->header = json_encode($header);
            $item->type = 'pleno';
            $item->status = 2;
            $item->save();       
    
            toastr()->success('Tambah Data berhasil', ['timeOut' => 5000]);
            return redirect()->route('step.meet',['id'=>md5($item->head)]);
    }

    private function genPDF($news)
    {
        $head = $news->doc;
        $data = compact('news','head');

        $name = 'konsultasi_'.$head->reg.'.pdf';
        $dir = 'assets/data/';
        $path = $dir.$name;

        $pdf = PDF::loadView('document.bak.doc.index', $data)->setPaper('a4', 'potrait');   
        Storage::disk('public')->put($path, $pdf->output());
        // return view('document.bak.doc.index',$data);
        // return $pdf->stream();

        $news->files = $path;
        $news->save();
    }

    public function step($id)
    {
        $meet = Meet::where(DB::raw('md5(head)'),$id)->first();   
        if($meet)
        {
            $data = "Dokumen ".$meet->doc->number;
            return view('document.barp.step',compact('data','meet'));
        }
        else
        {
            $head = Head::where(DB::raw('md5(id)'),$id)->first(); 

            $data = "Dokumen ".$head->number;
            return view('document.barp.create',compact('data','head'));
        }

    }

    public function doc($id)
    {
        $meet = Meet::where(DB::raw('md5(id)'),$id)->first(); 
        $news = $meet->doc->bak;
        $head = $meet->doc;
        $data = compact('news','head','meet');

        $pdf = PDF::loadView('document.barp.doc.index', $data)->setPaper('a4', 'potrait');   
        // return view('document.barp.doc.index', $data);
        return $pdf->stream();    
    }

    public function sign($id)
    {
        $news = News::where(DB::raw('md5(id)'),$id)->first(); 
        $single = true;
        return view('document.bak.sign',compact('news','single'));
    }

    public function signed(Request $request, $id)
    {
        $news = News::where(DB::raw('md5(id)'),$id)->first(); 
        
        $base64_image = $request->sign;
        if($base64_image)
        {
            if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
                $data = substr($base64_image, strpos($base64_image, ',') + 1);
    
                $data = base64_decode($data);
                $name = ($request->user == 'petugas') ? $news->doc->reg.'_petugas.png' : $news->doc->reg.'_pemohon.png' ;
                Storage::disk('public')->put($name, $data);       
                if($request->user == 'petugas')
                {
                    $news->sign = $name;

                }
                else
                {
                    $news->signs = $name;
                }
            }
    
            $news->save();
            $this->genPDF($news);
            toastr()->success('Tanda tangan berhasil, Complete', ['timeOut' => 5000]);            
        }
        else
        {
            toastr()->error('Invalid Data', ['timeOut' => 5000]);
        }
        return back();
        
    }

    public function next(Request $request, $id)
    {
        $meet = Meet::where(DB::raw('md5(id)'),$id)->first(); 
        if($meet)
        {          

            if($meet->status == 2)
            {
                $input = $request->input();     
                array_shift($input);
                $meet->item = json_encode($input); 
                $meet->status = 1;
                $meet->save();

                toastr()->success('Tambah Data berhasil, Complete', ['timeOut' => 5000]);
                return redirect()->route('meet.index');
            }

        }
        else
        {
            toastr()->error('Invalid Data', ['timeOut' => 5000]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meet $meet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meet $meet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meet $meet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meet $meet)
    {
        //
    }
}
