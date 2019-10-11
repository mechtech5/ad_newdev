<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserMail;
use Mail;
use App\User;
use App\VerifyUser;
use App\Role;
use App\Models\Country;
use App\Models\Status;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['state','city','country','role'])->get();
       
        return view('admin.dashboard.master.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','>', 1)->get();
        $countries = Country::all();
        return view('admin.dashboard.master.user.create',compact('roles','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = Status::all();
        $status_id = $status[2]->status_id;

        $data =  $request->validate([
            'user_catg_id'  => 'required|not_in:0',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users',
            'country_code'  => 'nullable',
            'state_code'    => 'nullable',
            'city_code'     => 'nullable',
            'zip_code'      => 'nullable|min:6|max:6|regex:/^[0-9]+$/',
            'mobile'        => 'nullable|min:10|max:11|regex:/^[0-9]+$/',

        ]);
        $password = 'adlaw@123';
        $data['password'] = $password;

        $data['password'] = Hash::make($password);
        $data['status'] = $status_id;
        
        $user = User::create($data);
        $user->attachRole(request()->user_catg_id);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $user['password'] = $password;

        Mail::to($user->email)->send(new UserMail($user));

        return redirect()->route('user.index')->with('success','User Created Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
   //      $token['token'] = str_random(40);
   //      $verify = VerifyUser::where('user_id',$id)->first();

   //      $verifyUser = $verify->update($token);
   // //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
