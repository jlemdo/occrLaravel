<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function dashboard(){
        
		$title =  auth()->user()->usertype.' Dashboard';
	   
		return view('dashboard',compact('title'));
		
    }

    //notifications

    public function notifications(){
        
      $title =  ' Notifications';
       
      return view('notifi',compact('title'));
      
      }

}
