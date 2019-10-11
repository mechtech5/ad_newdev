<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Todo;
class CalendarController extends Controller
{
    public function index(){
    	
    	$id = Auth::user()->id;
    	$todos = Todo::where('status','P')->where('user_id',$id)->orWhere('team_id',$id)->get();
    	
    	return view('calendar.index', compact('todos'));
    }
}
