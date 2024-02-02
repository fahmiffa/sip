<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Auth;

class Head extends Model
{
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

    public function region()
    {
        return $this->belongsTo(Village::class, 'village', 'id');
    }

    public function steps()
    {
        // return $this->belongsTo(Step::class, 'id', 'head');
        return $this->HasMany(Step::class, 'head', 'id');
    }

    public function kons()
    {
        // return $this->belongsTo(Step::class, 'id', 'head');
        return $this->HasOne(Consultation::class, 'head', 'id');
    }
}
