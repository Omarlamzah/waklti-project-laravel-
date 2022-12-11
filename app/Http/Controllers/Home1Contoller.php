<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class Home1Contoller extends Controller
{
    

    public function index()
    {
        $allagencys= Agence::all();
       
        return view('home')->with("allagenc",$allagencys);
    }

    public function aboutus()
    {
        return view('aboutus');
    }



    public function english()
    {
        $allagencys= Agence::all();
       
           return view('home')->with("allagenc",$allagencys);
    }
    public function arabic()
    {
        $allagencys= Agence::all();
        return view('homeARABIC')->with("allagenc",$allagencys);
    }




    

    
}




