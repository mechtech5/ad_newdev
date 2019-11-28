<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BatchMast;
use Auth;

class BatchMastController extends Controller
{
    public function index(){
        $batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
        return view('lawschools.dashboard.manage.batches.index',compact('batches'));
    }

    
    public function create()
    {
        return view('lawschools.dashboard.manage.batches.create');
        
    }

    
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $id ="";
        $data =$this->validation($request,$id);
        if(count($data) !=3){
            return back()->withInput()->with('warning','Batch name already in records');
        }
        $data['user_id'] = $user_id;
        $batch = BatchMast::create($data);
        return redirect()->route('batches.index')->with('success','Batch Inserted Successfully');    
    }

    
    public function edit($id)
    {
        $batch = BatchMast::find($id);        
        return view('lawschools.dashboard.manage.batches.edit',compact('batch'));

    }

    
    public function update(Request $request, $id)
    {
       
        $data =$this->validation($request,$id);
        if(count($data) !=3){
            return back()->withInput()->with('warning','Batch name already in records');
        }
        $batch = BatchMast::find($id)->update($data);
        return redirect()->route('batches.index')->with('success','Batch Updated Successfully');    
    
    }

   
    public function destroy($id)
    {
        $batch_delete = BatchMast::find($id)->delete();
        return redirect()->route('batches.index')->with('success','Batch Deleted Successfully');  
    }

    public function validation($request,$id){
        $data =  $request->validate([
                'start_date' =>  'required',
                'end_date'   =>  'required',
        ]);
        $batches    = BatchMast::where('user_id',Auth::user()->id)->get();
        if(count($batches) !=0){
            foreach ($batches as $batch) {
                if($batch->id != $id){
                    if($batch->name == $request->name){
                        $data['error'] = '1';
                    }
                }        
            } 
        }
       

        $data['name']= $request->name;    
        return $data;
    }
}
