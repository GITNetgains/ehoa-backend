<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Session;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class SigninController extends Controller
{
    function signup(Request $req)
    {
        // dd($req->all());
        try {
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string',],

            ]);
            if ($validator->fails()) {
                // dd($validator);
                return redirect('/signup')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // dd('okk');
                $user = new User;
                /*$user->username = $req->name;*/
                $user->name = $req->name;
                $user->email = $req->email;
                $user->register_type = 2;
                $user->status = 3;
                $user->password = Hash::make($req->password);
                $user->save();
                return redirect('/signin');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function signin(Request $request)

    {
        // dd('okk');
// dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {

            return redirect('/signin')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
        //    dd($credentials);
            if (auth()->User()->register_type == 1) {
                   $path = url('https://ehoa.app/admin/dashboard');
                    return redirect($path);
                // return redirect('admin/dashboard/something');
                // dd('ok');
            }
        } else{

            return redirect("/signin")->with('success','Please Enter Correct Credientials');
        }


    }
    function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/secure');
    }
    function showForgetPasswordForm(){
        return view('auth/email-reset-password');
    }
    function submitForgetPasswordForm(Request $req){
// dd($req->all());
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return redirect('/forget-password')
                        ->withErrors($validator)
                        ->withInput();
        } else{
            $token = Str::random(64);
           $ab= DB::table('password_resets')->insert([
                'email' => $req->email,
                'token' => $token,
                'created_at' => Carbon::now()
              ]);
            //   dd($ab);
              Mail::send('email.forgetPassword', ['token' => $token], function($message) use($req){
                $message->to($req->email);
                $message->subject('Reset Password');

            });
            return back()->with('message', 'We have e-mailed your password reset link!');
        }
    }

}
