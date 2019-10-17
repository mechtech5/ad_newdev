<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Role;
use App\User;
use App\VerifyUser;
use App\Mail\UserMail;
use App\Models\Country;
use App\Models\Status;
use App\Models\RoleUser;

class TeamManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $members = User::with(['state','city','country'])->where('parent_id',$id)->get();
       
        return view('teams.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('teams.create',compact('countries'));
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users',
            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
        ]);
       

        $this->create_user($data);

        return redirect()->route('teams.index')->with('success','Team member created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $member = User::find($id);
        return view('teams.edit',compact('countries','member'));
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
        $olduser = User::find($id);

        $data =  $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,'.$id,
            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
        ]);

        if($olduser->email != $data['email']){
            VerifyUser::where('user_id',$id)->delete();
            RoleUser::where('user_id',$id)->delete();
            User::find($id)->delete();
            $this->create_user($data);
        }
        else{
            $olduser->update($data);
        }
         return redirect()->route('teams.index')->with('success','Team member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // VerifyUser::where('user_id',$id)->delete();
        // RoleUser::where('user_id',$id)->delete();
        // User::find($id)->delete();
        // return redirect()->back()->with('success','Team member deleted successfully');
    }

    public function login_history(){
       $id =  request()->id;
       $member =  User::find($id);
       // return $member;
         return response()->json($member);
    }
    public function member_cases(){
       $id =  request()->id;
       $member =  User::find($id);
       // return $member;
         return response()->json($member);
    }
    public function create_user($data){
        $status = Status::all();
        $status_id = $status[2]->status_id;

        $data['password']  = Hash::make('adlaw@123');
        $data['status']    = $status_id;
        $data['parent_id'] = Auth::user()->id;

        if(Auth::user()->user_catg_id == '4'){
            $data['user_catg_id'] =  '6';
        }
        else{
            $data['user_flag'] = '2';   
        }

        $user = User::create($data);
        $user->attachRole($user->user_catg_id);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        $user['password'] = 'adlaw@123';
        Mail::to($user->email)->send(new UserMail($user));
    }

    // public function approve_decline_member(Request $request){
    //     $btnType = $request->btnType;
    //     $member_id = $request->member_id;

    //     $member = User::find($member_id);

    //     if($btnType=='approveBtn'){
    //         if(Auth::user()->user_catg_id == '4'){
    //             $member['user_flag'] ='ct';
    //         }
    //         else{
    //            $member['user_flag'] ='cl'; 
    //         }
    //     }
    //     else{
    //         $member['user_flag'] ='S';
    //     }

    //     $member->update($member->toArray());

    //     return "Team member approved successfully";

    // }
}
