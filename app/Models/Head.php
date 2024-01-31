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

    public function getroleAttribute()
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
}
