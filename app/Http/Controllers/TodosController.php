<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Todo;
use App\Models\Team;
use App\Models\UserTodo;
use App\Models\CaseMast;
use App\Helpers\Helpers;
class TodosController extends Controller
{
    public function __construct(){
        $this->query = Helpers::user_all_todos();
    }
    public function index(){
        $id =Auth::user()->id;
        
        if(Auth::user()->parent_id !=null){
            $todos = $this->query->where('user_id1',$id)->get();
        }else{
            $todos = $this->query->where('user_id',$id)->where('user_id1',$id)->get();
        }
          // return $todos;
        $todoCategory = '0';
      
    	return view('todos.index',compact('todos','todoCategory'));
    }
    public function create(){
        $client_ids = Helpers::deletedClients();
        $id =Auth::user()->id;
        $cases = CaseMast::with('casetype','client')
                        ->where('case_mast.user_id',$id)
                        ->where('case_mast.case_status','cr')
                        ->whereNotIn('cust_id',$client_ids)
                      ->get();
    	return view('todos.create',compact('cases'));
    }
    public function store(Request $request){
        $data = $this->validation($request);
    	$todo = Todo::create($data);
 
        if($request->page_name == 'todo'){
            return redirect()->route('todos.index')->with('success','To-dos created successfully');
        }
        else{

    	   return redirect()->back()->with('success','To-dos created successfully');
        }
    	
    }
    public function show($id){
        $todo = $this->query->find($id);      
        return view('todos.show',compact('todo'));
    }
    public function edit($id){
        $client_ids = Helpers::deletedClients();        
        $cases = CaseMast::with('casetype','client')
                        ->where('case_mast.user_id',Auth::user()->id)
                        ->where('case_mast.case_status','cr')
                        ->whereNotIn('cust_id',$client_ids)
                      ->get();
        $todo = $this->query->find($id);

        return view('todos.edit',compact('todo','cases'));
    }

    public function update(Request $request,$id){

        $data = $this->validation($request);

        $todo = Todo::find($id);
        if($todo->end_date != $request->end_date){
            $data['status'] = 'P';
        }

        $todo->update($data);

        return redirect()->route('todos.show',$id)->with('success','To-dos Updated successfully');
    }

    public function validation($request){
        $data = $request->validate([
            'title'         => 'required|max:100',
            'description'   => 'nullable',
            'start_date'    => 'required',
            'end_date'      => 'required|after_or_equal:start_date',
            'user_id1'      => 'required',
            
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['case_id'] = $request->case_id1 == "0" ? null : $request->case_id1;

        return $data;
    }


    public function todo_status_update(){
        $todo = Todo::find(request()->id);
        if($todo->user_id == Auth::user()->id){
            $data['status'] = 'C';
        }else{
            $data['status'] = 'A';
        }
        $todo->update($data);
        return "To-dos completed";
    }



    public function category_table_change(Request $request){ 
        $todoCategory =  $request->todoCategory;
        $status = $request->status;      

        $id= Auth::user()->id;
        if($todoCategory == '1'){
            if($status == 'all'){
                $todos = $this->query->where('user_id',$id)->where('user_id1', '!=' , $id)->get();
            }else{
                $todos = $this->query->where('status', $status)->where('user_id',$id)->where('user_id1', '!=' , $id)->get();
            }
        }else{
            if($status == 'all'){          
                $todos = $this->query->where('user_id',$id)->where('user_id1',$id)->get();      
            }else{
                $todos = $this->query->where('status', $status)->where('user_id',$id)->where('user_id1',$id)->get();            }
        }
        
    	return view('todos.todo_table',compact('todos'));
      

    }

    public function status_table_change(Request $request){
        $id= Auth::user()->id;
        $todos = $this->query->where('status',$request->status)->where('user_id1',$id)->get();
        return view('todos.todo_table',compact('todos'));
        // return $request->all();

    
    }
    // public function create_form(){
    //     $client_ids = Helpers::deletedClients();
    //     $id =Auth::user()->id;
    //     $cases = CaseMast::with('casetype','client')
    //                         ->where('case_mast.user_id',$id)
    //                         ->where('case_mast.case_status','cg')
    //                         ->whereNotIn('cust_id',$client_ids)
    //                         ->get();

    //     $members = User::where('parent_id',$id)->where('status','A')->get();
    //     return view('forms.todo.create',compact('members','cases'));
    // }
}
