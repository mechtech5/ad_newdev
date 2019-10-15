<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\CatgMast;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
use App\Models\CaseDetail;
use App\Models\CaseDoc;
use App\Models\CaseType;
use App\Models\CourtMast;
use App\Models\CaseStatusMast;
use App\Models\SubCatgMast;
use App\Models\CourtType;
use App\Helpers\Helpers;

class CaseMastController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function create(){       
		$id = explode(',', Request()->cust_id);
		$cust_id = $id[0];
		$page_name = $id[1];
		$case_types = CaseType::all();
		$courts = CourtType::all();
		$categories = CatgMast::all();
		$states = State::all();
		$deleted_clients = Helpers::deletedClients();
		$clients = Customer::where('user_id',Auth::user()->id)->whereNotIn('cust_id',$deleted_clients)->where('status_id','A')->get();  

		$case_status = CaseStatusMast::all();
		return view('case.create', compact('cust_id','case_types','courts','page_name','clients','categories','states','case_status'));
	}


	public function store(Request $request){

		$data = $this->caseValidation($request);
		if($data['court_type'] == '1'){
			$verify = $request->validate([
					'no_catg' => 'required|not_in:0',
				]
			);
			if($verify['no_catg'] == 'c_no'){
				$verify = $request->validate([
					'case_type_id' => "required|not_in:0",
					'c_d_number' => "required|string|min:1|max:5",
				],
				[
					'c_d_number.required' => 'The case number field is required.',
					'c_d_number.max' => 'The case number may not be greater than 4 characters.',
				]);
				$data['c_d_number'] 	= $verify['c_d_number'];
				$data['case_type_id'] 	= $verify['case_type_id'];
				$data['c_d_flag'] = 'c';
			}
			else{
				$verify = $request->validate([
					'c_d_number' => "required|string|min:1|max:5",
				],
				[
					'c_d_number.required' => 'The diary number field is required.',
					'c_d_number.max' => 'The diary number may not be greater than 4 characters.',
				]);
				$data['c_d_number'] 	= $verify['c_d_number'];
				$data['c_d_flag'] 		= 'd';
			}
		}
		else if($data['court_type'] == '2' || $data['court_type'] == '3'){
			$verify = $request->validate([
				'cnr' => 'required'
			]);			
			if($verify['cnr'] == '1'){
				$verify = $request->validate([
					'cnr_number' => 'required|min:14|max:16|string|unique:case_mast',
				]);
			}else{
				if($data['court_type'] == '3'){
					$verify = $request->validate([
						'state_code' => 'required|not_in:0',
						'city_code' => 'required|not_in:0',

					]);
					$data['state_code'] = $verify['state_code'];
					$data['city_code']  = $verify['city_code'];
				}
				else{
					$data['court_code'] 	= $request->court_code;
					$courts = CourtMast::where('court_code',$request->court_code)->first();
					$data['court_name'] = $courts->court_name;
				}
				$verify = $request->validate([
					'case_type_id' 	=> "required|not_in:0",
					'c_d_number' 	=> "required|string|min:1|max:5",
				],
				[
					'c_d_number.required' => 'The case number field is required.',
					'c_d_number.max' => 'The case number may not be greater than 4 characters.',
				]);
				$data['c_d_flag']		= 'c';
				$data['c_d_number'] 	= $verify['c_d_number'];
				$data['case_type_id'] 	= $verify['case_type_id'];

			}
		}
		else{
			$verify = $request->validate([
					'cnr_number' => 'required|min:14|max:16|string|unique:case_mast',
				]);
			$data['cnr_number'] = $verify['cnr_number'];
		}

		if($request->affidavit_status == '1'){
			$verify = $request->validate([
					'affidavit_date' => 'required|date_format:Y-m-d',
				]);
			$data['affidavit_date'] = $verify['affidavit_date'];
		}

		$categories = CatgMast::where('catg_code',$data['catg_code'])->first(); 
		$subcategories = SubCatgMast::where('subcatg_code',$data['subcatg_code'])->first(); 

		$data['subcatg_desc'] =  $subcategories->subcatg_desc;
		$data['catg_desc']    = $categories->catg_desc;

		$data['user_id'] = Auth::user()->id;
		CaseMast::create($data);
		
		$page_name = $request->page_name;
		if($page_name == 'clients'){
			return redirect()->route('clients.show',$data['cust_id'])->with('success','Client case inserted successfully');
		}
		else{
			return redirect()->route('case_diary.index',['caseBtn' =>'cg'])->with('success','Case inserted successfully');
		}

	}


	public function show($id){

		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_detail= CaseMast::with('casetype','client')
		->where('case_id', $case_id)
		->first();
		$case_notes = CaseNotes::where('case_id', $case_id)->get();
		$case_hearings = CaseDetail::where('case_id',$case_id)->get();
		$case_docs = CaseDoc::where('case_id',$case_id)->get();

		return view('case.show', compact('case_detail','case_notes','case_hearings','case_docs','page_name'));
	}


	public function edit($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_types = CaseType::all();
		$courts = CourtMast::all();
		$categories = CatgMast::all();       
		$caseDetail = CaseMast::where('case_id',$case_id)->first();
		$clients = Customer::where('user_id',Auth::user()->id)->where('status_id','A')->get();  
		return view('case.edit',compact('caseDetail','courts','case_types','page_name','clients','categories'));
	}


	public function update(Request $request, $id){
		$data = $this->caseValidation($request);

		if($data['case_status'] == 'cg'){
			$data['case_over_date'] = null;
		}
		$categories = CatgMast::where('catg_code',$data['catg_code'])->first(); 
		$subcategories = SubCatgMast::where('subcatg_code',$data['subcatg_code'])->first(); 

		$data['subcatg_desc'] =  $subcategories->subcatg_desc;
		$data['catg_desc']    = $categories->catg_desc;

		CaseMast::where('case_id',$id)->update($data);

		$page_name = $request->page_name;

		if($page_name == 'clients'){
			return redirect()->route('clients.show',$data['cust_id'])->with('success','Client case Updated successfully');
		}
		else{
			return redirect()->route('case_diary.index',['caseBtn' =>'cg'])->with('success','Case Updated successfully');
		}
	}


	public function destroy($id){
		CaseMast::where('case_id',$id)->delete();
		return redirect()->back()->with('success', 'Client case deleted successfully');
	}
	public function caseValidation($request){

		$data = $request->validate([
			'court_type'		=> 'required|not_in:0',
			'case_reg_date'     => 'required|date_format:Y-m-d',
			'case_title'        => 'required|string|min:5|max:200',
			'catg_code'      	=> 'required|not_in:0',
			'subcatg_code'      => 'required|not_in:0',
			'appellant_name'    => 'nullable|string|max:250',
			'respondant_name'   => 'nullable|string|max:250',
			'case_fees'         => 'nullable|max:12|regex:/^\d{0,9}(\.\d{1,2})?$/',
			'case_status'       => 'required|not_in:0',
			'cust_id'           => 'required|not_in:0',
			'case_description'  => 'required|string',
			// 'case_over_date'    => 'nullable|date_format:Y-m-d|after_or_equal:case_reg_date',
			// 'case_type_id'      => 'required|not_in:0',
			// 'court_code'        => 'nullable|not_in:0',
			// 'city_code'         => 'nullable',
			// 'case_number'       => 'required|string|min:6|max:15',
			
		]);      
	

		 $courts = CourtType::where('court_type',$request->court_type)->first();
		 $data['court_type_desc'] = $courts->court_type_desc;
		 return $data;


	}
	
}
