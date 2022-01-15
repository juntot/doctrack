<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MailService;
use DB;
use Hash;

class UserController extends Controller
{
    //login view
    function login() {
        if(session()->get('auth.email')){
            return redirect('/');
        }else{
            return view('/login');
        }
    }

    // AUTH LOGIN
    function authLogin() {

        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];
        
        // $user = DB::table('users')->where('email', request('email'))->orWhere('username', request('email'))->get();
        $user = DB::select('select * from users where ( email = :email) and status = 1', 
        [
            request('email')
        ]);
        

        if(count($user) > 0 && Hash::check(request('password'), ($user[0]->password)))
        {
            session([
                'auth.fullName' => $user[0]->firstName.' '.$user[0]->lastName, 
                'auth.email' => $user[0]->email, 
                'auth.type' => $user[0]->type,
                'auth.dept' => $user[0]->deptId_,
            ]);
            return redirect()->route('home');
        }

        request()->flash();
        $errMsg = 'Invalid Email or Password';
        return redirect()->back()->withErrors([$errMsg]);
        
        // session(['auth.email' => 'email', 'auth.type' => 0]);
        // return redirect()->route('home');
            
    }

    // LOGOUT
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }


    // CHANGE PASS
    public function changePass(){

        if(!request('password'))
        return redirect()->back();
        
        // $user = DB::table('users')->where('email', request('email'))->get();
        // if(count($user) > 0 && Hash::check(request('oldpass'), ($user[0]->password)))
        // {
        DB::table('users')
            ->where('email', session()->get('auth.email'))
            ->update(['password'=> Hash::make(request('password'))]);
        return redirect()->back();
        // }
        // return response()->json(['err' => 'old password not match']);


    }

    // RESET PASSWORD
    public function resetPass(){
        
        $email = request('email');
        DB::table('users')->where('email', $email)->update(['password'=> Hash::make('1234')]);
        
        // check if email found
        // return response to check their email for forget pass email
        // return response if email not found or if email is disabled account

        // $email = 'ubec.creative@gmail.com';
        // Mail::to($email)->send(new \App\Mail\FormMail('email body', 'subject'));
    }


    // GET USERS
    function getUsers(){
        $users = DB::select('
                select e.email, e.firstName, e.lastName, 
                e.deptId_, e.type, e.status, d.deptName
                from users e
                left join DEPARTMENT d
                    on e.deptId_ = d.deptId
        ');
        $depts = DB::select('select * from DEPARTMENT where status = 1 order by deptName');
        return view('manageUser', compact('users', 'depts'));
    }

    // GET USER BY ID
    function getUserId(){
        $email = request('email');
        $users = DB::select('select * from users where email = :email', [
            'email' => $email
        ]);
        return  $users;
    }

    // REGISTER
    public function register(){
        
        if(!request('email') || !request('firstName') || !request('lastName'))
        return redirect()->back();
        
        if(!request('password')){
            request()->merge(['password'=> Hash::make('1234')]);
        }else{
            request()->merge(['password'=> Hash::make(request('password'))]);
        }
            
        
    	$data = DB::table('users')->insertOrIgnore(request()->except(['_token']));        
        return redirect()->back();

    }

    // udpate user
    function updateUser(){
        $email = request('email');
        // return request()->all();
        DB::table('users')->where('email', $email)->update(request()->except(['_token']));
        return redirect()->back();
    }

    function forgetPass(){
        $email = request('email');
        $user = DB::table('users')->select('email', 'firstName')->where('email', $email)->first();
        
        if($user){
            $randPass = $this->randomPassword();
            $body = "Hi $user->firstName, <br/>
            Here's your new password ".$randPass;

            DB::table('users')
            ->where('email', $email)
            ->update(['password'=> Hash::make($randPass)]);
            

            try {
                $email = 'ubec.creative@gmail.com';

                MailService::sendMail($email, 'Forget Password', $body);
                // return true;
                return view('mail.eMailAlert', ['result' => true]);
            } catch (\Throwable $th) {
            }
        }else{
            // return false;
            return view('mail.eMailAlert', ['result' => false]);
        }
        
    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
}
