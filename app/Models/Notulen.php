<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $table = 'view_consultations';

    public function doc()
    {   
        return $this->HasOne(Head::class, 'id', 'head'); 
    }
}
