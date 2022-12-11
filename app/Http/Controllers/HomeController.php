<?php

namespace App\Http\Controllers;

use App\Mail\Testmail;
use App\Models\Agence;
use App\Models\Mailusers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $allagencys= Agence::all();
        
        return view('home')->with("allagenc",$allagencys);
    }


    public function sendmail()
    {

        $users= Mailusers::all(["mail"]);
        $usersmail=[];
        $i=0;
        foreach ($users as $us){
            $usersmail[$i]=$us->mail;
            $i=$i+1;
        }
        Mail::to($usersmail)->send(new Testmail());
        return  "send";
    }



    public function adddemail(Request $request)
    {

        Mailusers::create([
            "mail"=>$request->mail
        ]);
      
        $allagencys= Agence::all();
        
        return view('home')->with("allagenc",$allagencys);
    }











    
    public function searchform(Request $request)
    {
     
        $allagencys= DB::table("agences")->where("name","=",$request->textsearch)->get();
        
       return   view('result')->with("allagenc",$allagencys);
    }



    

    
}
