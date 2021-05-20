<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Quotation;

class UserController extends Controller
{  
        public function uploadAvater(Request $request)
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);           
            if($request->hasFile('image')){
               $id = Auth::id();             
               $avater = DB::table('users')->select('avater')->where('id', '=' , $id)->get();               
               $filename = $request->image->getClientOriginalName();
               Storage::delete('public/images/'.$avater[0]->avater);
               $request->image->storeAs('images',"$filename",'public');
               DB::update('update users set avater ="'.$filename.'"  where id = ?', [$id]);        
            }
            return redirect()->back()->with('success','Avater uploaded successfully!')->with('path',$filename);                
        
        }


    public function index()
    {

         return "hello boy";
     
    }



    
}