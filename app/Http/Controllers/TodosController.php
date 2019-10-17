<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Todo;
use App\Models\CaseMast;
use App\Helpers\Helpers;
class TodosController extends Controller
{
    public function index(){
        $id =Auth::user()->id;
    	$todos = Todo::with('user')->where('user_id',$id)->where('team_id',$id)->get();
    	$todoCategory = '1';

        
    	return view('todos.index',compact('todos','todoCategory'));
    }
    public function create(){
        $client_ids = Helpers::deletedClients();
        $id =Auth::user()->id;
        $cases = CaseMast::with('casetype','client')
                            ->where('case_mast.user_id',$id)
                            ->where('case_mast.case_status','cg')
                            ->whereNotIn('cust_id',$client_ids)
                            ->get();
                      
        $members = User::where('parent_id',Auth::user()->id)->where('user_flag', '=','A')->where('status','A')->get();
    	return view('todos.create',compact('members','cases'));
    }
    public function store(Request $request){
    	$data =  $request->validate([
    		'title' 		=> 'required|max:100',
    		'description' 	=> 'required|max:191',
    		// 'privacy'		=> 'required',
    		'start_date'	=> 'required',
    		'end_date'		=> 'required',
    		'case_id'		=> 'required',
    		'team_id'		=> 'required',
    		'user_id'		=> 'required',
    	]);

    	$count  = count($data['team_id']);
    	for($i=0; $i< $count ; $i++){
    		$datas = [
    					'title'			=> $data['title'],
    					'description'	=> $data['description'],
    					// 'privacy'		=> $data['privacy'],
    					'start_date'	=> $data['start_date'],
    					'end_date'		=> $data['end_date'],
    					'case_id'		=> $data['case_id'] == "null" ? null : $data['case_id'],
    					'user_id'		=> $data['user_id'],
    					'team_id'		=> $data['team_id'][$i],

    				];    	
    		Todo::create($datas);
    	}
    	return redirect()->back()->with('success','To-dos created successfully');

    	
    }
    public function show($id){
    	$todoFind = Todo::find($id);
    	$team_id = $todoFind->team_id;
    	$todos = Todo::where('id',$id)->get();
    	if($team_id == Auth::user()->id){
    		$todoCategory = '1';
    	}
    	else{
    		$todoCategory = '0';
    	}
	
		return view('todos.index',compact('todos','todoCategory'));


    }
    public function todoTableChange(Request $request){
    	$todo = $request->todo;

    	if($todo == '1'){
    		$todos = Todo::with('user')->where('user_id',Auth::user()->id)->where('team_id',Auth::user()->id)->get();   
    	}
    	else{
    		$todos = Todo::with('user')->where('user_id',Auth::user()->id)->where('team_id','!=', Auth::user()->id)->get();
    	}
    
    	return view('todos.todo_table',compact('todos'));
    }
}
