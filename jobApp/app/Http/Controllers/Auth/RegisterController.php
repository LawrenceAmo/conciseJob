<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
   
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'firstName' => ['required', 'string', 'max:255'],
    //         'lastName' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'promoCode' => [ 'string', 'max:10', 'exists:affiliates,url_code'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //        // 'status' => ['required'],
    //         //'role' => ['required']
    //     ]);
    // }

   

    public function register(Request $request)
    {                 
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $admin_code = $request->admin_code;

        // create a user tokens
        $value = ''.$last_name.''.$email.''.$password.''.$role;
        $token = hash('sha256', $value, false);
        $signature = hash('sha384', $token.''.now(), false);
        $verify_token = Hash::make($signature);

        $all_admin_codes = 1;
        if ($all_admin_codes) {
           return "Please enter a valid Admin Code...";
        }

        $user= User::create([
        'first_name' => $data['firstName'],
        'last_name' => $data['lastName'],
        'email' => $email,
        'roleID' => $roleID,
        'password' => Hash::make($password),
        ]);

        return $user;
    }

    ////////////////////////////////////////////// Log in
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
//     Hash::check($password, $db_password)
        if (1) {
            return "all is well";
        }
       return "ERROR! Invalid credentials, One or more input(s) are incorrect...";
    }
}
