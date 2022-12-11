<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\File as XmlConfigurationFile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

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
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function detailsagence($user)
    {
       $user=Auth::user();

        $data=[];
        $data[0]=$user;
        $data[1]=$user->agences;

        return view("profile")->with("data",$data);
    }

    public function updateagence(Request $request)
    {
      $id =$request->idagence;
	
      $agence= Agence::find($id );
      $agence->name =$request->name;
      $agence->email=$request->email;
      $agence->phone=$request->phone;
      $agence->Country=$request->Country;
      $agence->Agency_type=$request->Agency_type;
      $agence->bio=$request->bio;
      $agence->id_users=$request->id_users;

     

      $image =$request->pic;
      if( $image){

        
          $imagename =$image->getClientOriginalName();
          $image->move(public_path("/agencesPic"),$imagename);
          $imagename =$request->pic->getClientOriginalName();
          $agence->pic=$imagename;



          if (file_exists(public_path("/agencesPic"))) {

            @unlink(public_path("/agencesPic"));
     
        }
         

      }


      
      $agence->save();
      $user=Auth::user();

      $data=[];
      $data[0]=$user;
      $data[1]=$user->agences;

      return view("profile")->with("data",$data);
    }


    
    
}
