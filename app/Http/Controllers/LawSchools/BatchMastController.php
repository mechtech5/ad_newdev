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
        $user_id    = Auth::user()->id;

        $data       = $request->validate(['name'=>'unique:batch_mast,name,'.$user_id.'user_id',
                                           'start_date'=>'nullable',
                                           'end_date'=>'nullable', 
                                            ]);
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
        $user_id    = Auth::user()->id;
        $data       = $request->validate(['name'=>'unique:batch_mast,user_id,'.$user_id,
                                           'start_date'=>'nullable',
                                           'end_date'=>'nullable', 
                                            ]);
        $data['user_id'] = $user_id;
        $batch = BatchMast::find($id)->update($data);
        return redirect()->route('batches.index')->with('success','Batch Updated Successfully');        
    
    }

   
    public function destroy($id)
    {
        $batch_delete = BatchMast::find($id)->delete();
        return redirect()->route('batches.index')->with('success','Batch Deleted Successfully');  
    }
}
