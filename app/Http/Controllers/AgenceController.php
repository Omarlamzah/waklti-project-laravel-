<?php

namespace App\Http\Controllers;

use App\Mail\Testmail;
use App\Models\Agence;
use App\Models\Mailusers;
use App\Models\User;
use App\Notifications\CreatPost;
use Error;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Backtrace\File;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::check()) {
            return view("putAgence.resAgenc");
        }
        return view("auth.login");
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "country"=>"required",
             "bio" =>"required",
             "phone" =>"required",
             "email" =>"required",
             "pic"=>"required",
              "name" =>"required",
               "agency_type"=>"required",
 
        ]);


         $image =$request->pic;
        if( $image){
            $imagename =$image->getClientOriginalName();
            $image->move(public_path("/agencesPic"),$imagename);



            
        if (file_exists(public_path("/agencesPic"))) {

            @unlink(public_path("/agencesPic"));
     
        }

        }
        

  
    

    
        $data=[
            "name"  =>$request->name,
            	"email"=>$request->email,
                "phone" =>$request->phone,	
                "Country"	=>$request->country,
                "Agency_type"	=>$request->agency_type,
                "bio"=>$request->bio,
                "pic"=>$imagename,
                "id_users"=>Auth::id()
        ];


          $agenc= Agence::create($data);

        $datanotify=$data=[
            "idp"  =>$agenc->id,
            "name"  =>$request->name,
            	"email"=>$request->email,
                "phone" =>$request->phone,	
                "Country"	=>$request->country,
                "Agency_type"	=>$request->agency_type,
                "bio"=>$request->bio,
                "pic"=>$imagename,
                "id_users"=>Auth::id()
        ];

try{
    $users= Mailusers::all(["mail"]);
    $usersmail=[];
    $i=0;
    foreach ($users as $us){
        $usersmail[$i]=$us->mail;
        $i=$i+1;
    }
    Mail::to($usersmail)->send(new Testmail());
}
catch(Error){
  
}
           $allagencys= Agence::all();
       
            $users=User::where("id","!=",Auth::user()->id)->get();
            Notification::send($users,new CreatPost($datanotify));
                        
           return   view('home')->with("allagenc",$allagencys);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function show(Agence $agence)
    {
        return  view("showAgency")->with("agence",$agence);
    }


    public function shouuserinNoti($idp)
    {
        $agence=Agence::find($idp);

        $idnotif=DB::table("notifications")->where("data->agencepost->idp","=",$idp)->pluck("id")->first();

        
        DB::table("notifications")->where("id","=",$idnotif)->update(["read_at"=>now()]);

        return  view("showAgency")->with("agence",$agence);
    }


	
    

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {

            $agence->delete();
            $user=Auth::user();

            $data=[];
            $data[0]=$user;
            $data[1]=$user->agences;
            $path="/agencesPic"."/".$agence->pic;
            Storage::delete(public_path($path));
    
            return view("profile")->with("data",$data);
    }
}
