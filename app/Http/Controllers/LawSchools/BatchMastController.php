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
        $data       = $request->validate(['name'=>'unique:batch_mast',
                                           'start_date'=>'nullable',
                                           'end_date'=>'nullable', 
                                            ]);
        $data['user_id'] = $user_id;
        $batch = BatchMast::create($data);
         if ($batch) {
            return redirect()->back()->with('message', 'Batch added successfully');
            }else{
            return redirect()->back()->with('messageError', 'Batch Not added');

        }        
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $batch_updates = BatchMast::where('id',$id)->get();
        return view('lawschools.dashboard.manage.batches.edit',compact('batch_updates'));

    }

    
    public function update(Request $request, $id)
    {
        $user_id    = Auth::user()->id;
        $data       = $request->validate(['name'=>'unique:batch_mast',
                                           'start_date'=>'nullable',
                                           'end_date'=>'nullable', 
                                            ]);
        $data['user_id'] = $user_id;
        $batch = BatchMast::where('id', $id)->update($data);
         if ($batch) {
            return redirect()->back()->with('message', 'Batch updated successfully');
            }else{
            return redirect()->back()->with('messageError', 'Batch Not updated');

        }        
    
    }

   
    public function destroy($id)
    {
        $batch_delete = BatchMast::where('id',$id)->delete();
         if ($batch_delete) {
            return redirect()->back()->with('message', 'Batch deleted successfully');
            }else{
            return redirect()->back()->with('messageError', 'Batch Not deleted');

        }   
    }
}
