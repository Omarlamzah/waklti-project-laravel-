<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

   protected $fillable=  ["name",	"email"	,"phone",	"Country"	,"Agency_type"	,"bio",	"pic" ,"id_users"];


   

   public  function user()
    {
        return $this->belongsTo(User::class,"id_users");
    }



    public  function deatails()
    {
        return $this->hasOne(Agencedetails::class,"id_agences");
    }
}
