<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\emrecords;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{

    public function index()
    {
        // $users = emrecords::all();
        return view('Index')->with("users",$users);
    }
    public function recoreds()
    {
        $users = emrecords::all();
        return view('Index')->with("users",$users);
    }

    public function get_data(string $id)
    {
        $users = emrecords::where('employee_number', 'like', "%{$id}%")->get();
        return $users;
    }

      public function upload_records(Request $request)
      {
       $users = Excel::import(new UserImport(), $request->file('userEx'));
       return "success";
      }

      public function export()
      {
           return Excel::download(new UserExport(), "usersDemoXL.xlsx");
      }

    // public function register()
    // {
    //     return view('auth.register');
    // }   public function login()
    // {
    //     return view('auth.login');
    // } 

    // public function pricing()
    // {
    //     return view('pg.pricing');
    // }

    // public function about()
    // {
    //     return view('pg.about');
    // }

     

    //    public function import(Request $request)
    //    {
    //         $users = Excel::import(new UserImport(), $request->file('userEx'));
    //      return back();
    //    }

      
}
