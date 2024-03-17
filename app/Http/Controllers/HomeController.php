<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;
use Auth;
use App\Models\Consultation;
use App\Models\Verifikator;
use App\Models\Notulen;


class HomeController extends Controller
{
    public function index()
    {        

        // admin, sekretariat
        if(Auth::user()->ijin('master_formulir'))
        {
            $head  = Head::all();        
            $verif = Head::doesnthave('kons')->get()->count();     
            $kons  = Head::has('kons')->get()->count();     
    
            $bak  = Head::whereHas('bak',function($q){
                $q->where('grant',1);
            })->get()->count(); 
            
            $barp  = Head::whereHas('barp',function($q){
                $q->where('grant',1);
            })->get()->count(); 
    
            return view('home',compact('head','verif','kons','bak','barp'));
        }  

        // notulen (teknis)
        if(Auth::user()->ijin('bak'))
        {      
            $comp  = head::where('do',1)->whereHas('notulen',function($q){
                $q->where('users',Auth::user()->id);
            })->count();     

            $task  = head::where('do',0)->whereHas('notulen',function($q){
                $q->where('users',Auth::user()->id);
            })->count();   
            
            // $comp  = head::has('tax')->count();     
            // $task  = head::doesntHave('tax')->count();    
            return view('main',compact('task','comp'));
        }     

        // verifikator
        if(Auth::user()->ijin('doc_formulir'))
        {      
            $comp  = Verifikator::where('verifikator',Auth::user()->id)
                                ->whereHas('doc',function($q){
                                    $q->where('grant',1);    
                                })->count();
            $task  = Verifikator::where('verifikator',Auth::user()->id)
                                ->whereHas('doc',function($q){
                                    $q->where('grant',0);    
                                })->count();
            return view('main',compact('task','comp'));
        }

        // kabid
        if(Auth::user()->ijin('verifikasi_bak'))
        {
            $task  = head::whereHas('bak',function($q){$q->where('grant',0);})->count(); 
            $comp  = head::whereHas('bak',function($q){$q->where('grant',1);})->count();         
            return view('general',compact('task','comp'));
        }
    
    }
}
