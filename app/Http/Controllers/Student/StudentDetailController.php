<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\QualCatg;
use App\Models\ProfessionMast;
use App\Models\ReservationClass;
use App\Models\Religion;
use App\Models\Relation;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\LanguageMast;
use App\Models\DesignationMast; 

use App\Models\StudentMast;
use App\Models\StudentQual;
use App\Models\GuardianMast;
use App\Models\StudentAddress;
use App\Models\StudentDocs;
use Auth;
class StudentDetailController extends Controller
{
    public function index(){
        StudentMast::where()
    	return view('student.student_detail.index');
    }
    public function create(){
        $qual_catgs = QualCatg::where('qual_catg_code', '!=',4)->get();
        $professions = ProfessionMast::all();
        $reservations = ReservationClass::all();
        $religions = Religion::all();
        $relations = Relation::all();
        $countries = Country::all();
        $languages = LanguageMast::all();
        $designations = DesignationMast::all();

    	return view('student.student_detail.create',compact('qual_catgs','professions','reservations','religions','relations','countries','languages','designations'));
    }
    public function store(Request $request){
     

        $data = [
            'user_id'             => Auth::user()->id,
            'f_name'              => $request->f_name,
            'm_name'              => $request->m_name,
            'l_name'              => $request->l_name,
            'mobile'              => $request->s_mobile,
            'dob'                 => $request->dob,
            'email'               => $request->email,
            'gender'              => $request->gender,
            'reservation_class_id'=> $request->reservation_class_id,
            'religion_id'         => $request->religion_id,
            'blood_group'         => $request->blood_group,
            'spec_ailment'        => $request->spec_ailment,
            'age'                 => $request->age,
            'nationality_id'      => $request->nationality_id,
            'taluka'              => $request->taluka,
            'language_id'         => $request->language_id,
            's_ssmid'             => $request->s_ssmid,
            'f_ssmid'             => $request->f_ssmid,
            'aadhar_card'         => $request->addhar_card,
            'qual_catg_code'      => $request->qual_catg_code,
            'qual_code'           => $request->qual_code,
            'qual_year'           => $request->qual_year,
            'semester'            => $request->semester,
            'batch'               => $request->batch,
            'status'              => $request->status,
            'addm_date'           => $request->addm_date,
            'enroll_no'           => $request->enroll_no,
            'roll_no'             => $request->roll_no,
            'bank_name'           => $request->bank_name,
            'bank_branch'         => $request->bank_branch,
            'account_name'        => $request->account_name,
            'account_no'          => $request->account_no,
            'ifsc_code'           => $request->ifsc_code,
        ];
// return $request->all();
        if($request->s_photo !=null){
            $verify = $request->validate([
                's_photo' =>'required|image|mimes:jpeg,png,jpg' 
            ]);
            $filename = $request->f_name.'_'.time().'.'.$request->s_photo->getClientOriginalExtension();
            $year = date('Y');

            $image = $request->s_photo->storeAs('public/colleges/college_'.Auth::user()->id.'/students/'.$year.'', $filename);
            $data['photo'] = 'colleges/college_'.Auth::user()->id.'/students/'.$year.'/'.$filename;

        }
        else{
            $data['photo'] = null;
        }
        
        $student = StudentMast::create($data);
      
       
// Academic Details
        for($i= 0 ; $i < count($request->qual_name); $i++) {
            $student_qual =[
                's_id'      => $student->id,
                'name'      => $request->qual_name[$i],
                'school'    => $request->qual_clg[$i],
                'board'     => $request->qual_board[$i],
                'pass_year' => $request->qual_years[$i],
                'pass_division'=> $request->qual_division[$i],
                'pass_marks'   => $request->qual_marks[$i]
            ];
            StudentQual::create($student_qual);
        } 
// Guardian_mast
        for($i= 0 ; $i < count($request->relation); $i++) {
            $guardian = [
                's_id'          => $student->id,
                'relation_id'   => $request->relation[$i],
                'name'          => $request->g_name[$i],
                'mobile'        => $request->g_mobile[$i],
                'employer'      => $request->employer[$i],
                'designation_id'=> $request->designation_id[$i],
                'profession_id' => $request->profession_status[$i],
                'work_type_id'  => $request->work_status[$i],
                'employment_type'=>$request->employment_type[$i],
            ];
            if($request->g_check[$i] == '0'){
                $guardian['photo'] = null;
            }else{
                $filename = $guardian['name'].'_'.$i.'_'.time().'.'.$request->g_photo[$i]->getClientOriginalExtension();
                $year = date('Y');
                $image = $request->g_photo[$i]->storeAs('public/colleges/college_'.Auth::user()->id.'/parents/'.$year.'', $filename);
                $guardian['photo'] = 'colleges/college_'.Auth::user()->id.'/parents/'.$year.'/'.$filename;
            }
            GuardianMast::create($guardian);
        }
    
        for($i= 0 ; $i < count($request->address); $i++) {
            $address = [
                's_id'        => $student->id,              
                'country_code'=> $request->country_code[$i],
                'state_code'  => $request->state_code[$i],
                'city_code'   => $request->city_code[$i],
                'address'     => $request->address[$i],
                'zip_code'    => $request->zip_code[$i]     
            ];
            $country = Country::where('country_code', $address['country_code'])->first();
            $state = State::where('state_code',$address['state_code'])->first();
            $city = City::where('city_code',$address['city_code'])->first();

            $address['country_name'] = $country->country_name;
            $address['state_name'] = $state->state_name; 
            $address['city_name'] = $city->city_name; 

            if($request->same_as != 'on'){
                $address['addr_type'] = $i == 0 ? 'L' : 'P';
                StudentAddress::create($address);
            }else{
                $address['addr_type'] = 'S';
            }

        }
        if($request->same_as == 'on'){
          StudentAddress::create($address);
        }
    
        for($i= 0 ; $i < count($request->qual_doc_type_id); $i++) {
            $stud_docs= [
                's_id'              => $student->id,
                'qual_catg_code'    => $request->qual_catg_code,
                'qual_doc_type_id'  => $request->qual_doc_type_id[$i]
            ];
            if($request->doc_check[$i] == '0'){
                $stud_docs['doc_url'] = null;
            }else{
                $filename = $request->f_name.'_'.$request->qual_doc_type_id[$i].'_'.time().'.'.$request->doc_url[$i]->getClientOriginalExtension();
                $year = date('Y');
                $image = $request->doc_url[$i]->storeAs('public/colleges/college_'.Auth::user()->id.'/documents/'.$year.'', $filename);
                $stud_docs['doc_url'] = 'colleges/college_'.Auth::user()->id.'/documents/'.$year.'/'.$filename;
            }
          
            StudentDocs::create($stud_docs);
        }
       
        //return $request->doc_check;
        return redirect()->route('student_detail.create')->with('success','Student created successfully');
	   
    	
    }
    public function temp_data(Request $request){
       

       $value = $request->session()->put('key', 'value');
        print_r($value);
      
    }
    public function validation(){
            // return $request->all();
        // $request->validate([
        //     'f_name'        => 'required|max:30|min:1|string',
        //     'm_name'        => 'nullable|max:30|string',
        //     'l_name'        => 'required|max:30|min:1|string',
        //     's_mobile'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'dob'           => 'required|date_format:Y-m-d',
        //     'email'         => 'nullable|email|s_email',
        //     'gender'        => 'required|not_in:""',
        //     'reservation_class_id' => 'required|not_in:""',
        //     'religion_id'   => 'nullable',
        //     'blood_group'   => 'nullable',
        //     'spec_ailment'  => 'nullable',
        //     'age'           => 'nullable|min:2',
        //     'nationality_id'=> 'nullable',
        //     'taluka'        => 'nullable|max:85|string',
        //     'language_id'   => 'nullable',
        //     's_ssmid'       => 'nullable|max:9|min:9',
        //     'f_ssmid'       => 'nullable|max:8|min:8',
        //     'aadhar_no'     => 'nullable|min:12|max:12|string',
        //     'qual_catg_code'=> 'required',
        //     'qual_code'     => 'required',
        //     'qual_year'     => 'required',
        //     'batch'         => 'required',
        //     'semester'      => 'required',
        //     'addm_date'     => 'required|date_format:Y-m-d',
        //     'enroll_no'     => 'nullable|string',
        //     'roll_no'       => 'nullable|string',
        //     'bank_name'     => 'nullable|max:85|string',
        //     'bank_branch'   => 'nullable|max:45|string',
        //     'account_name'  => 'nullable|max:100|string',
        //     'account_no'    => 'nullable',
        //     'ifsc_code'     => 'nullable',  
        //     'status'        => 'required'      

        // ]);
    }
}
