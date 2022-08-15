<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\tracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/login');
    }
    public function regis()
    {
        return view('admin.register');
    }


    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        $result = DB::table('admins')
            ->where(['email' => $email])
            ->get();




        if (isset($result[0])) {
            $db_pwd = Crypt::decrypt($result[0]->password);
            $result[0]->password;


            if ($db_pwd == $password) {


                $request->session()->put('ADMIN_LOGIN', TRUE);
                $request->session()->put('ADMIN_ID', ($result['0']->id));
                $request->session()->put('ADMIN_name', ($result['0']->name));
                $request->session()->put('ADMIN_email', $email);

                return redirect('admin/dashboard');
            } else {
                $request->session()->flash('error', 'please enter valid details');
                return redirect('admin');
            }
        } else {
            return redirect('admin');
        }
    }


    public function dashboard()
    {
        $userid = session('ADMIN_ID');
        $date = date('Y.m.d');
        $array = tracker::where(['user_id' => $userid])->get();
        $ar = tracker::avg('spent');



        return view('admin.day', ['array' => $array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($request->password == $request->password_confirmation) {
            $rand = rand(111111, 999999);
            $arr = [
                "name" => $request->fname,

                "email" => $request->email,

                "password" => Crypt::encrypt($request->password),

            ];
            $querry = DB::table('admins')->insert($arr);
            $request->session()->flash('success', 'you are now register!');
            return redirect('admin');
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => "user not added!",

            ]);
        }
    }
}
