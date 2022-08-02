<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function admin(Request $req)
    {
        $users = DB::table('users')
                    ->orderBy('id', 'DESC')
                    ->get();
                    
        return view('student_admin', ['users' => $users]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();

        return view('student_tbl', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
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
            "password_confirmation" => "required"
        ]);

        // dd($validator);die;
        if (!$validator->fails()) {
            DB::table('users')->insert([
                "full_name" => $req->fname,
                "phone_number" => $req->phone_number,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "confirm_password" => Hash::make($req->c_password),
                "role" => $req->role,
                "age" => $req->age,
            ]);
            return redirect('admin/data');
        } else {
            return view('student_admin', ['error' => $validator->errors()->first()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = DB::table('users')
            ->where('id','=', $id)
            ->first();

        return view('edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        // dd($id);
        $user = User::where('id', $id)->first();
        
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
            "age" => "required|digits_between:3,30",
        ]);
        
        if (!$validator->fails()) {
            DB::table('users')
                ->where('id', '=', $id)
                ->update([
                "full_name" => $req->fname,
                "phone_number" => $req->phone_number,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "confirm_password" => Hash::make($req->c_password),
                "role" => $req->role,
                "age" => $req->age,
            ]);
            return redirect('admin/data');
        } else {
            return view('edit', ['error' => $validator->errors()->first(), 'user' => $user]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "<script>
            alert('Hello')
        </script>";
         DB::table('users')->delete($id);

        return redirect()->back();
    }
}
