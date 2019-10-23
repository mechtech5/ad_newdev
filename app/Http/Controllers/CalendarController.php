<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Todo;
use App\Models\CaseMast;
use App\Models\CaseLawyer;
use App\Helpers\Helpers;
class CalendarController extends Controller
{
    public function index(){
    	
    	$id = Auth::user()->id;
    	$todos = Todo::where('status','P')->where('user_id',$id)->orWhere('team_id',$id)->get();
    	$client_ids = Helpers::deletedClients();
        $cases = CaseMast::with('casetype','client')
                        ->where('case_mast.user_id',$id)
                        ->where('case_mast.case_status','cr')
                        ->whereNotIn('cust_id',$client_ids)
                        ->get();
      
    	return view('calendar.index', compact('todos','cases'));
    }
    public function case_member(){
    	$assign_mem = CaseLawyer::with('member')->where('deallocate_date',null)->where('case_id',request()->case_id)->get();
    	return $assign_mem;
    }
}
