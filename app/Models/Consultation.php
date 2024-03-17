<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;

class Consultation extends Model
{
    use HasFactory;

    public function getkonsAttribute()
    {                

       if($this->konsultan)
       {  
            $val = explode(",",$this->konsultan);
            
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
    public function getnotulensAttribute()
    {                

       if($this->notulen)
       {  
            $val = explode(",",$this->notulen);
            
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

    public function doc()
    {
        return $this->belongsTo(Head::class, 'head', 'id');   
    }

    public function not()
    {
        return $this->HasOne(User::class, 'id', 'notulen');   
    }
}
