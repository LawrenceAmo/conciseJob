<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\emrecords;
use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Imports\UpdatesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PayUService\Exception;

class HomeController extends Controller
{

    public function index()
    {
        $users = emrecords::all();
        return view('Index')->with("users",$users);
    }
    public function recoreds()
    {
        $users = emrecords::all();
        return view('Index')->with("users",$users);
    }

    public function get_records()
    {
            $data = DB::table('emrecords')->get();  
            return $data;
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

         public function update_records(Request $request)
       {
            $users = (new UserImport)->toArray($request->file('userEx'));
            $keys = array_keys($users[0][0]);

            foreach ($users[0] as $user) {

                if (array_search('Surname', $keys) && count($keys) < 3) {
                    DB::table('emrecords')->where('employee_number','=',$user['Employee Number'])
                    ->update( ["last_name" => $user["Surname"]]);

               }elseif (array_search('Manager Employee Number', $keys) && count($keys) < 3) {
                DB::table('emrecords')->where('employee_number','=',$user['Employee Number'])
                -> update( ["manager_employee_number" => $user["Manager Employee Number"]  ]);

              }else {
                try {
                    DB::table('emrecords')->where('employee_number','=',$user['Employee Number'])
                        -> update( [
                            "first_name" => $user["First Name"],
                            "last_name" => $user["Surname"],
                            'dob' => $user['Date of Birth'],
                            'position' => $user['Position'],
                            'start_date' => $user['Start Date'],
                            'department' => $user['Department'],
                            'annual_salary' => $user['Annual Salary'],
                            'manager_employee_number' => $user['Manager Employee Number'],
                            'project_c1' => $user['Project Code 1'],
                            'ptoject_c2' => $user['Project Code 2'],
                            'project_c3' => $user['Project Code 3'],
                       
                          ]);
                } catch (\Exception $ex) {
                   return "UNKNOWN ERROR!!! Please check your spread sheet and enter valid input, then try again";
                }
              }
            }
            return "success";
       }

      
}
