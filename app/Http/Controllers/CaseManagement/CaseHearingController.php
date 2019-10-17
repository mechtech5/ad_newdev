<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
use App\Models\CaseDetail;
use App\Models\CaseLawyer;
class CaseHearingController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function create(){
		$id = explode(',', request()->case_id);
		$case_id = $id[0];
		$page_name = $id[1];
		$case = CaseMast::where('case_id',$case_id)->first();
		$assign_mem = CaseLawyer::with('member')->where('deallocate_date',null)->where('case_id',$id)->get();
	
		return view('case_management.case_hearing.create',compact('case','page_name','assign_mem'));
	}

	public function store(Request $request){
	

		$data = $this->validation($request);
		dd($data);
		$all_lawyer[]= request()->lawyer_names;
		$count = 0;
		foreach ($all_lawyer as $type) {
		$count+= count($type);
		$lawyer_team=implode(';',$type);

		}
		$judges_name[]= request()->judges_name;
		$count = 0;

		foreach ($judges_name as $types) {
		$count+= count($types);
		$judge_team=implode(';',$types);

		}
		$data['lawyer_names']=$lawyer_team;
		$data['judges_name']=$judge_team;

		$cust_id=request()->case_id;

		CaseDetail::insert($data);
		if($request->page_name == 'clients'){
			return redirect()->route('case_mast.show', $data['case_id'].',clients')->with('success', 'Case Hearing Inserted Successfully');
		}
		else{
			return redirect()->route('case_mast.show', $data['case_id'].',case_diary')->with('success', 'Case Hearing Inserted Successfully');
		}
	}

	public function show($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_hearings = CaseDetail::where('case_id',$case_id)->get();
		return view('case_management.case_hearing.show',compact('case_hearings','page_name','case_id'));
	}

	public function edit($id){

		$id = explode(',', $id);
		$case_tran_id = $id[0];
		$page_name = $id[1];

		$edit_detail=CaseDetail::where('case_tran_id',$case_tran_id)->first();
		$names=$edit_detail->lawyer_names;
		$sep_name=explode(";",$names);

		$judge=$edit_detail->judges_name;
		$jug_name=explode(";",$judge);

		return view('case_management.case_hearing.edit',compact('edit_detail','sep_name','jug_name','page_name'));

	}  

	public function update(Request $request ,$id){
		$data = $this->validation($request);
		$lawyer[]=request()->lawyer_names;
		foreach($lawyer as $total){
		$count= count($total);
		$lawyer_total=implode(';',$total);

		}
		$judge[]=request()->judges_name;
		foreach($judge as $j_total){
		$j_count= count($j_total);
		$judge_total=implode(';',$j_total);

		}

		$data['lawyer_names']=$lawyer_total;
		$data['judges_name']=$judge_total;

		CaseDetail::where('case_tran_id',$id)->update($data);
		if($request->page_name == 'clients'){ 
			return redirect()->route('case_mast.show', $request->case_id.',clients')->with('success', 'Case Hearing Updated Successfully'); 
		}
		else{
			return redirect()->route('case_mast.show', $request->case_id.',case_diary')->with('success', 'Case Hearing Updated Successfully'); 
		}

	}
	public function destroy($id){

	CaseDetail::where('case_tran_id',$id)->delete();

	return redirect()->back()->with('success', 'Case Hearing Deleted Successfully');;


	}

	public function validation($request){
		$data= $request->validate([
			'case_id'          => 'required',
			'user_id'          => 'required',
			'cust_id'          => 'required',
			'hearing_date'     => 'required|date_format:Y-m-d',
			'start_time'       => 'required',
			'lawyer_names'     => 'required',
			'judges_name'      => 'required',
			'next_hearing_date'=> 'required|date_format:Y-m-d',
			'case_charged'     => 'nullable|numeric',
			'case_charges_type'=> 'required|not_in:0'

		]);
		return $data;
	}
}
