<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class Head extends Model
{
    protected $appends = ['verif','task','dokumen'];

    use HasFactory, SoftDeletes;

    public function getverifAttribute()
    {                

       if($this->verifikator)
       {  
          $val = explode(",",$this->verifikator);
            
           foreach($val as $item)
            {
                $user = User::where('id',$item)->first();
                if($user)
                {
                    $name []= $user->name;
                }
            }
           
            return $name;
       } 
       else
       {
            return null;
       }
    }

    public function gettahapAttribute()
    {                

       if($this->step == 2)
       {  
            $val = explode(",",$this->verifikator);
            
           foreach($val as $item)
            {
                if(Auth::user()->id == $item)
                {
                    $user = User::where('id',$item)->first();
                    if($user)
                    {
                        $name = $user->roles->kode;
                        break;
                    }
                }
            }
           
            return $name;
       } 
       else
       {
            return null;
       }
    }

    public function gettaskAttribute()
    {                

       if($this->verifikator)
       {  
           $val = explode(",",$this->verifikator);       

           if(in_array(Auth::user()->id,$val))
           {
               return true;
           }
           else
           {
              return false;
           }
           
       } 
       else
       {
            return false;
       }
    }

    public function getDokumenAttribute()
    {
        $barp =  $this->barp()->exists();
        $bak  =  $this->bak()->exists();
        $kons =  $this->kons()->exists();

        if($barp)
        {
            $val = 'BARP';
        }
        else if($bak)
        {
            $val = 'BAK';
        }
        else if($kons)
        {
            $val = 'KONSULTASI';
        }
        else
        {
            $val = 'VERIFIKASI';
        }
        return $val;
    }

    public function getnumberAttribute()
    {            
        $bak  =  $this->bak()->exists();
        $barp =  $this->barp()->exists();

        if($barp)
        {
            return str_replace('SPm','BARP',str_replace('600.1.15','600.1.15/PBLT',$this->nomor));
        }
        elseif($bak)
        {
            return str_replace('SPm','BAK',str_replace('600.1.15','600.1.15/PBLT',$this->nomor));
        }
        else
        {
            // return $this->nomor;
            return null;
        }
    }

    public function region()
    {
        return $this->belongsTo(Village::class, 'village', 'id');
    }

    public function steps()
    {       
        return $this->HasMany(Step::class, 'head', 'id');
    }

    public function head()
    {        
        return $this->HasMany(Head::class, 'id', 'parent')->withTrashed();
    }

    public function kons()
    {   
        return $this->HasOne(Consultation::class, 'head', 'id');
    }

    public function surat()
    {   
        return $this->HasOne(Schedule::class, 'head', 'id');
    }

    public function bak()
    {   
        return $this->HasOne(News::class, 'head', 'id');
    }

    public function barp()
    {   
        return $this->HasOne(Meet::class, 'head', 'id');
    }

    public function notulen()
    {   
        return $this->HasOne(Notulen::class, 'head', 'id');
    }

    public function attach()
    {   
        return $this->HasOne(Attach::class, 'head', 'id');
    }

    public function tax()
    {   
        return $this->HasOne(Tax::class, 'head', 'id');
    }
}
