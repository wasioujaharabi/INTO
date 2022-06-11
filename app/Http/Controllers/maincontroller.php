<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class maincontroller extends Controller
{
    function login(){
        return view('auth.login');
    }
    function register(){
        return view('auth.register');
    }
    function save(Request $request){
        $request->validate([
            'Name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:8|max:12'
        ]);
        $admin = new Admin;
        $admin->Name = $request->Name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request-> password);
        $save = $admin->save();

        if($save){
            return back()->with('success','New User created');
        }
        else{
            return back()->with('fail','Something went wrong');
        }
    }
    function check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
       ]);

       $userInfo = Admin::where('email','=', $request->email)->first();

       if(!$userInfo){
           return back()->with('fail','We do not recognize your email address');
       }else{
           //check password
           if(Hash::check($request->password, $userInfo->password)){
               $request->session()->put('LoggedUser', $userInfo->id);
               return redirect('dashboard');

           }else{
               return back()->with('fail','Incorrect password');
           }
       }
   }
   function dashboard(){
    $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
       return view('dashboard',$data);
   }
   function logout(){
       if(session()->has('LoggedUser')){
           session()->pull('LoggedUser');
           return redirect('/Auth/login');
       }
   }
}