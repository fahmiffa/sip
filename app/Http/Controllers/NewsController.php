<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Head;
use App\Models\Role;
use App\Models\User;
use App\Models\Notulen;
use App\Models\District;
use DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:bak');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::whereNot('status',1)->first(); 

        if($news)
        {
            return redirect()->route('step.news',['id'=>md5($news->head)]);
        }
        else
        {    
            
            $val = Notulen::where('users',Auth::user()->id);  
            $da = $val->paginate(10);
    
            $data = "Berita Acara Konsultasi";        
            $ver = false;        
            return view('document.bak.home',compact('da','data','ver'));            
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = News::whereNot('status',1)->first(); 
        if($news)
        {
            return redirect()->route('step.news',['id'=>md5($news->id)]);
        }
        else
        {
            $doc  = head::has('surat')->doesnthave('bak')->latest()->get();
            $data = "Tambah BAK";
            return view('document.bak.create',compact('data','doc'));
        }        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'doc'       => 'required',  
            'north'      => 'required',                                                          
            'east'       => 'required',                                                          
            'west'       => 'required',                                                          
            'south'      => 'required',                                                          
            'kondisi'    => 'required',                                                          
            'permanensi' => 'required',                                                          
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        $header = [
            'north'=>$request->north,
            'east'=>$request->east,
            'west'=>$request->west,
            'south'=>$request->south,
            'kondisi'=>$request->kondisi,
            'permanensi'=>$request->permanensi,
          ];

        $item = new News;
        $item->head = $request->doc;
        $item->plan = $request->build;
        $item->header = json_encode($header);
        $item->type = 'konsultasi';
        $item->status = 5;
        $item->save();       

        toastr()->success('Tambah Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('step.news',['id'=>md5($item->head)]);
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
        $news = News::where(DB::raw('md5(head)'),$id)->first(); 

        if($news)
        {
            $data = "Dokumen ".$news->doc->nomor;
            return view('document.bak.step',compact('data','news'));
        }
        else
        {           
            $head = Head::where(DB::raw('md5(id)'),$id)->first();   
            $data = "Dokumen ".$head->nomor;
            return view('document.bak.create',compact('data','head'));   
        }
    }

    public function doc($id)
    {
        $news = News::where(DB::raw('md5(id)'),$id)->first(); 
        $head = $news->doc;
        $data = compact('news','head');

        if($news->type == 'konsultasi')
        {
            $pdf = PDF::loadView('document.bak.doc.index', $data)->setPaper('a4', 'potrait');    
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
        $news = News::where(DB::raw('md5(id)'),$id)->first(); 
        if($news)
        {
            if($news->status == 5)
            {                               
        
                $val = $request->val;
                $width = $request->width;

                for ($i=0; $i < count($val); $i++) { 
                    $item[] = ['uraian'=>$val[$i], 'value'=> $width[$i]];                    
                }                 
                $news->item = json_encode(['informasi_umum'=>$item]);
                $news->status = 4;
                $news->save();
    
                toastr()->success('Tambah Data berhasil, lanjutkan', ['timeOut' => 5000]);
                return back();
            }

            if($news->status == 4)
            {
                $input = $request->input();
                array_shift($input);

                foreach ($input as $key => $value) {                    
                    $item[] = ['uraian'=>$value[0], 'dimensi'=>$value[1], 'note'=>$value[2]];
                }          
                $old = (array) json_decode($news->item);
                $item = array_merge(['informasi_bangunan_gedung'=>$item], $old);  
        
                $news->item = json_encode($item);
                $news->status = 3;
                $news->save();

                toastr()->success('Tambah Data berhasil, lanjutkan', ['timeOut' => 5000]);
                return back();
            }

            if($news->status == 3)
            {
                $input = $request->input();
                $old = (array) json_decode($news->item);

                array_shift($input);
                $item = array_merge($input, $old);          
                $news->item = json_encode($item);
                $news->status = 2;
                $news->save();

                toastr()->success('Tambah Data berhasil, lanjutkan', ['timeOut' => 5000]);
                return back();
            }

            if($news->status == 2)
            {
                $news->note = $request->note;
                $news->status = 1;
                $news->save();

                $this->genPDF($news);
                toastr()->success('Tambah Data berhasil, Complete', ['timeOut' => 5000]);
                return redirect()->route('news.index');
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
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
