<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use DB;
use PDF;
use App\Models\Meet;

class HeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:verifikasi_bak');
    }

    public function bak()
    {
        $val = News::latest();
        $da = $val->paginate(10);
        $data = "Berita Acara Konsultasi";
        $ver = true;
        return view('document.bak.index',compact('da','data','ver'));
    }

    public function docBak($id)
    {
        $news = News::where(DB::raw('md5(id)'),$id)->first(); 
        $head = $news->doc;
        $data = compact('news','head');

        $pdf = PDF::loadView('document.bak.doc.index', $data)->setPaper('a4', 'potrait');    
        return $pdf->stream();

        // dd($pdf->stream());
        return view('verifikator.doc.index',$data);    
    }

    public function approveBak(Request $request, $id)
    {
        $head = News::where(DB::raw('md5(id)'),$id)->first();   
        $head->grant = 1;
        $head->save();
        toastr()->success('Verifikasi Data berhasil', ['timeOut' => 5000]);
        return back();                
    }

    public function barp()
    {
        $val = Meet::latest();
        $da = $val->paginate(10);
        $data = "Berita Acara Rapat Pleno";
        $ver = true;
        return view('document.barp.index',compact('da','data','ver'));
    }

    public function docBarp($id)
    {
        $meet = Meet::where(DB::raw('md5(id)'),$id)->first(); 
        $news = $meet->doc->bak;
        $head = $meet->doc;
        $data = compact('news','head','meet');

        $pdf = PDF::loadView('document.barp.doc.index', $data)->setPaper('a4', 'potrait');   
        // return view('document.barp.doc.index', $data);
        return $pdf->stream();    
    }

    public function approveBarp(Request $request, $id)
    {
        $head = Meet::where(DB::raw('md5(id)'),$id)->first();   
        $head->grant = 1;
        $head->save();
        toastr()->success('Verifikasi Data berhasil', ['timeOut' => 5000]);
        return back();                
    }
}
