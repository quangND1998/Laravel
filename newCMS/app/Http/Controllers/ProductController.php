<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index(){
        $users= User::get();
        return view('userlist',compact('users'));
   }

   
   
}
