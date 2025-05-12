<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Redirect, Session, Auth, Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('Front.Auth.login');
    }

    public function customLogin(Request $request) 
    {
        $input = $request->all();
        $rule = array(
            'email' => 'required ',
            'password' => 'required'
        );
        $validator = Validator::make($input,$rule);
        if($validator->fails()) 
        {
            return Redirect::back()->withErrors($validator);

        } else {

            // check if the given user exists in db
            if(Auth::attempt(['email'=> $input['email'], 'password'=> $input['password']])) {
                // check the user role
                if(Auth::user()->role_id == 1) {
                    return redirect()->route('home');  // admin
                }
                elseif (Auth::user()->role_id == 2) { 
                    return redirect()->route('home')->with('success', 'You have loggedIn successfully');
                    
                } else {
                    return redirect()->back()->with('error', 'Email verification is pending. Please verify your registered email');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }
    }

    public function register(Request $request) 
    {        
        $request = $request->all();
        $rule = array(
            'name' => 'required | max:80',
            'email' => 'required | unique:users,email',
            'password' => [
                    'required',
                    'string',
                    'min:6',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ]
        );
        $validator = Validator::make($request,$rule); 
        if($validator->fails()) 
        {            
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            
            $newUser           = new User;
            $newUser->name     = $request['name'];
            $newUser->email    = $request['email'];
            $newUser->password = Hash::make($request['password']);
            $newUser->role_id  = 2;
            $newUser->remember_token = '1234';
            $newUser->save();

            Session::flash('message', 'Congratulations! You have registered successfully. Please verify your registered email.'); 
            return Redirect::route('otp', encrypt($newUser->id));
        }
    }

    public function otp($id) {
        return view('Front.Auth.otp_verification', compact('id'));
    }

    public function otpVerify(Request $request, $id) 
    {
        $request = $request->all();
        $otp = implode("", $request['otp']);
        $user = User::where('id', decrypt($id))->first();
        if($user['remember_token'] == $otp) {

            User::where('id', '4')->update([
                'remember_token' => '',
                'email_verified_at' => '1'
            ]);
            Auth::login($user);
            return redirect()->route('showonboardform')->with('success', 'OTP verified successfully. Please login to continue');

        } else {
            return redirect()->back()->with('error', 'Invalid OTP');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout successfully');
        //return redirect('/login');
    }
}
