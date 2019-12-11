<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Todo;
use App\Models\CaseMast;
use App\Models\CaseLawyer;
use App\Models\CaseDetail;
use App\Helpers\Helpers;
class CalendarController extends Controller
{
    public function index(){
    	
    	$id =Auth::user()->id;
        if(Auth::user()->parent_id !=null){
            $todos = Helpers::user_all_todos()->where('user_id1',$id)->where('status','P')->get();
        }else{
            $todos = Helpers::user_all_todos()->where('user_id',$id)->where('status','P')->get();
        }
        // return $todos;
    	$client_ids = Helpers::deletedClients();
        $cases = CaseMast::with('casetype','client')
                    ->where('case_mast.user_id',$id)
                    ->where('case_mast.case_status','cr')
                    ->whereNotIn('cust_id',$client_ids)
                  ->get();

        $case_assign = CaseLawyer::where('user_id1',$id)->where('deallocate_date',null)->get();

        // return $case_assign;
        $case_id = collect($case_assign)->map(function($e){
            return $e->case_id;
        });
        // return $case_id;
        $hearings = CaseDetail::with(['case','client'])->where('hearing_date','>=', date('Y-m-d') )->whereIn('case_id',$case_id)->get();

        $hearings = collect($hearings)->filter(function($e) use($id){
            return in_array($id, json_decode($e->lawyer_names));
        });
       
    	return view('calendar.index', compact('todos','cases','hearings'));
    }
    public function case_member(){
        if(request()->case_id == '0'){
            $members = User::where('parent_id',Auth::user()->id)->where('status','!=','S')->get();
        }else{
            $members = CaseLawyer::with('member')->where('deallocate_date',null)->where('case_id',request()->case_id)->get();
        }  	
    	return $members;
    }
}
