<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencedetails extends Model
{
    use HasFactory;



    public  function agence()
    {
        return $this->belongsTo(Agence::class,"id_agences");
    }
}
