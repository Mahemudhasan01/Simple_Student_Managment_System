<?php

namespace App\Http\Controllers;

use App\Jobs\ForgotPasswordJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\isEmpty;

class RegistrationController extends Controller
{
    public function login(Request $req)
    {
        // dd($req->email);    
        $user = DB::table('users')
            ->where('email', '=', $req->email)
            ->first();
        if (isset($user)) {
            if ($user->email == $req->input('email') && Hash::check($req->password, $user->password)) {
                session()->put('user', $user);
                return redirect('users');
            } else {
                return view('login', ['error' => "Your Password is wrong"]);
            }
        }else{
            return view('login', ['error' => "Your Email is wrong"]);
        }
    }

    //User Registartion 
    public function register(Request $req)
    {
        
        $validator =  Validator::make($req->all(), [
            "fname" => "required",
            "phone_number" => "required|digits_between:1,13",
            "email" => "required|email",
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            "password_confirmation" => "required",
            // "age" => "required|digits_between:3,30",
        ]);

        if($req->age > 30 && $req->age < 3)
        {
            return view('login', ['error' => "The age must be between 3 and 30 digits"]);
        }
        // dd($req->all());
        // dd($validator->fails());die;
        if (!$validator->fails()) {
            DB::table('users')->insert([
                "full_name" => $req->fname,
                "phone_number" => $req->phone_number,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "confirm_password" => Hash::make($req->c_password),
                "age" => $req->age,
            ]);
            return redirect('users');
        } else {
            return view('login', ['error' => $validator->errors()->first()]);
        }
    }

    public function adminLogin(Request $req)
    {
        $user = DB::table('users')
            ->where('email', '=', $req->email)
            ->orWhere('password', '=', $req->password)
            ->get();
        
        if (count($user) > 0) {
            if ($user[0]->email == $req->input('email') && Hash::check($req->password, $user[0]->password)) {

                if ($user[0]->role == 1) {
                    session()->put('user', $user);
                    return redirect('admin/data');
                } else {
                    return view('admin_login', ['error' => "You Are not admin"]);
                }
            } else {
                return view('admin_login', ['error' => "Your email And Password is wrong"]);
            }
        } else {
            return view('admin_login', ['error' => "User not exist"]);
        }
    }

    //Send user on Forgot Templet
    public function forgot()
    {
        return view('forgot');
    }

    //Send Email
    public function sendForgotEmail(Request $req)
    {

        // $user = DB::table('users')
        //     ->where('email', '=', $req->email)
        //     ->first();

        $user = User::where('email', '=', $req->email)->first();

        // dd($user);
        if ($user != null) {
            // dispatch(new ForgotPasswordJob($user));
            ForgotPasswordJob::dispatch($user)->delay(now()->addSecond(5));
            // Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect('https://mailtrap.io/inboxes/1828484/messages');
        } else {

            return redirect()->back()->withErrors(
                'Wrong password or this account not approved yet.',
            );
        }
    }

    public function sendOnRestPage()
    {
        return view('reset_password');
    }

    public function resetPassword(Request $req)
    {
        // dd($req->newPassword);
        // dd($req->password_confirmation);

        $validator =  Validator::make($req->all('password', 'password_confirmation'), [
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            "password_confirmation" => "required",
        ]);

        if (!$validator->fails()) {
            DB::table('users')
                ->where('email', '=', $req->email)
                ->update([
                    "password" => Hash::make($req->password),
                    "confirm_password" => Hash::make($req->password_confirmation),
                ]);
            return view('admin_login', ['success' => "Your Password Successfully Changed"]);
        } else {
            return redirect()->back();
        }
    }

    //LogOut
    public function logout()
    {
        session()->forget('user');
        return redirect('/');
    }
}
