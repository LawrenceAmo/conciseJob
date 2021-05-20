<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Login;
use App\User;
use App\Admin;
use App\Course;
use App\Enrolment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('role');
        // $this->middleware('log')->only('index');
        //  $this->middleware('subscribed')->except('store');     
    }
 
    /////// Get overall enrollments
    public function getAllEnrolments()
    {
        return $enrolments = DB::table('enrolments')
        ->Join('users', 'users.id', '=', 'enrolments.studentID')
        ->Join('courses', 'courses.courseID', '=', 'enrolments.courseID')
        ->orderBy('enrolmentID','ASC');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {        
        $request->chartPeriod === null ? $chartPeriod = 0 : $chartPeriod = $request->chartPeriod; // toggle between months or days for admin statistics
        
        $userID = Auth::id();
        $enrolments = $this->getAllEnrolments()->where('enrolments.instructorID','=',$userID)->get(); 

        $users = DB::table('users')->get();
        $course = DB::table('courses')->where([ ['id','=',$userID],['delete_course','!=',1] ])->count();
        $earnings = DB::table('earnings')->where('id','=',$userID)->get();
        $logins = DB::table('logins')->where('email','=',Auth::User()->email)->orderByRaw('created_at DESC')->paginate(10);

        $enrollement = DB::table('admin_statistics')->where('userID',$userID)->get();
        $getDate = json_decode($enrollement[0]->enrollement,true);
        $courseStatistics = json_decode($enrollement[0]->course,true);

        return view('admin.index')
        ->with('enrolments',$enrolments)
        ->with( 'course',$course)
        ->with( 'students', count($users))
        ->with( 'logins', $logins)
        ->with( 'earnings', $earnings)
        ->with( 'users', $users)
        ->with( 'chartPeriod', $chartPeriod)
        ->with( 'getDate', $getDate)
        ->with( 'courseStatistics', $courseStatistics);
    }

    //
    public function showProfile()
    {
        $id = Auth::id();
        $user = DB::table('users')->where('id', '=' , $id)->get();
        $contact = DB::table('contacts')->where('id', '=' , $id)->get();

        return view('admin.profile')->with('user',$user)
        ->with('contact',$contact);
    }

//
    public function security()
    {
        $id = Auth::id();
        $email = User::where('id','=', $id)->value('email');
        $logins = Login::where('email','=',$email)->orderByRaw('created_at DESC')->paginate(12);
        $users = User::where('id','=', $id)->get();
        return view('admin.security')->with('logins',$logins)->with('users',$users);
    }

 // Save Security data
 public function saveSecurity(Request $request)
 {
    // dd($request->all());
    $id = Auth::id();
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;
        $factorAuth = (int)$request->factorAuth;
        $loginAlert = (int)$request->loginAlert;

        if($currentPassword != null){
            $request->validate([
                    'currentPassword' => 'required|password',
                    'newPassword' => 'min:6',
                    'confirmPassowrd' => 'same:newPassword',
                ]);
                $password = User::where('id','=', $id)->value('password');
                    if (Hash::check($currentPassword, $password)) {  // check if user password matches database records
                        DB::table('users')->where('id', $id)->update(['password' => Hash::make($newPassword)]);
                    }else{
                        return redirect()->back()->with('error', 'your Current password is incorrect, Please insert correct Password!');
                    }
        }
        DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'factorAuth'=> $factorAuth,
                        'loginAlert'=> $loginAlert
                        ]);

     return redirect()->back()->with('success', 'Your security settings were successfully changed');

    }

// get user details (info and contacts)
    public function edit()
    { 
        $id = Auth::id();
        $user = DB::table('users')->where('id', '=' , $id)->get();
        $contact = DB::table('contacts')->where('id', '=' , $id)->get();

        return view('admin.edit')->with('user',$user)
        ->with('contact',$contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)       //////// Update user's Info
    {
        $id = Auth::id();

        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:248',
            'password' => 'required|password',
            'email' => 'required',
        ]);
           $username= $request->username;
           $gender =$request->gender;
           $password =$request->password;
           //$membership =$request->membership;
           $email =$request->email;
           $altmail =$request->altmail;
           $phone =$request->phone;
           $web =$request->web;
           $social =$request->social;
           $country =$request->country;
           $city =$request->city;
           $surbub =$request->surbub;
           $street =$request->street;
           $discription =$request->discription;
           $goal =$request->goal;
           $dob = $request->dob;
           $filename = $request->image;

           //proccess avater if user uploads it
        if($filename != null){
        if($request->hasFile('image')){
           $avater = DB::table('users')->select('avater')->where('id', '=' , $id)->get();
           $filename = $request->image->getClientOriginalName();
           $ext = $request->image->extension();
           //writing avater/image name, to be unique
           function uniqFile($id,$filename,$ext)    {
            $file = md5($filename)."".uniqid($filename, true);
           return "pro".$id."".md5($file)."le.".$ext ;
            }
            // storing user avater to storage
            $filename =  uniqFile($id,$filename,$ext);
           Storage::delete('public/profile/'.$avater[0]->avater);
           $request->image->storeAs('profile',"$filename",'public');
        }
    }else{
        $filename = $request->img;
    }
     // update users general info
        DB::table('users')
        ->where('id', $id)
         ->update([
         'avater' => $filename,
         'email' => $email,
         'dob' => $dob,
    //   'membership' => $membership,
         'gender' => $gender,
         'username' => $username,
         'password' => Hash::make($password)]);

        DB::table('contacts')
             ->where('id', $id)
              ->update([
              'altmail' => $altmail,
              'phone' => $phone,
              'web' => $web,
              'social' => $social,
              'country' => $country,
              'city' => $city,
              'surbub' => $surbub,
              'street' => $street,
              'discription' => $discription,
              'goal' => $goal]);

        return redirect()->to('admin/profile/profile')->with('success','Profile updated successfully!');

    }

}
