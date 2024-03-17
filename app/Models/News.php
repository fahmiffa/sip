<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function doc()
    {         
        return $this->belongsTo(Head::class, 'head', 'id'); 
    }

    public function barp()
    {   
        return $this->HasOne(News::class, 'head', 'id');
    }
}
