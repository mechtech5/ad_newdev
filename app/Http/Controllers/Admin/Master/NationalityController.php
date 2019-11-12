<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nationality;
class NationalityController extends Controller
{
 
 
    public function index()
    {
        $nationalities = Nationality::all();
        return view('admin.dashboard.master.nationality.index',compact('nationalities'));
    }

  
    public function create()
    {
        return view('admin.dashboard.master.nationality.create');
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);

        $nationalities = Nationality::all(); 
        if(count($nationalities) !=0){
            foreach ($nationalities as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        Nationality::create($data);
        return redirect()->route('nationality.index')->with('success', 'Nationality Name  Inserted Successfully');
    }

    
    public function edit($id)
    {
        $nationality = Nationality::find($id);
        return view('admin.dashboard.master.nationality.edit', compact('nationality'));
    }
    public function update(Request $request,$id){
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);
        Nationality::find($id)->update($data);
        return redirect()->route('nationality.index')->with('success', 'Nationality Name Updated Successfully');
    }
    public function destroy($id){
        Nationality::find($id)->delete();
        return redirect()->back()->with('success', 'Nationality Name Deleted Successfully');
    }
}
