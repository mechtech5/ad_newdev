<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\UserQualification;
use App\Models\CourseMast;
use App\Models\CollegeCourse;
use App\Models\QualCatg;
use App\Models\QualMast;
class CourseController extends Controller
{
     public function index()
    {
      $courses = CollegeCourse::where('user_id', Auth::user()->id)->get();
     
      return view('lawschools.dashboard.courses.index',compact('courses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = QualCatg::all();
        // dd($courses);
        return view('lawschools.dashboard.courses.create',compact('courses'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $id = '';
        $data =  $this->validation($request,$id);
        if(count($data) !=6){
           return back()->withInput()->with('warning','course name already in records');
        }
     
        $data['user_id'] = Auth::user()->id;
        CollegeCourse::create($data);
        return redirect()->route('course.index')->with('success','Course Inserted Successfully');
    }   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CollegeCourse::where('id',$id)->first();
        return view('lawschools.dashboard.courses.show',compact('data'));
    
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CollegeCourse::find($id);
        $courses = QualCatg::all();
        
        return view('lawschools.dashboard.courses.edit',compact('data','courses'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data =  $this->validation($request,$id);
        if(count($data) !=6){
            return back()->withInput()->with('warning','course name already in records');
        }
    
        CollegeCourse::find($id)->update($data);
        
        return redirect()->route('course.index')->with('success','Course Updated Successfully');
       
    }
   
    public function destroy($id)
    {
        CollegeCourse::find($id)->delete();
        return redirect()->route('course.index')->with('success','Course Deleted Successfully');
    }

    public function validation($request,$id){
        $data =  $request->validate([
            'qual_catg_code'  =>  'required',
            'qual_code'       =>  'required',
            'course_duration' =>  'required|numeric|min:2|max:60',
            'syllabus'        =>  'nullable'
        ],
        [
            'qual_catg_code.required'   => 'This field is required.',
            'qual_code.required'        => 'This field is required.',
            'course_duration.required'  => 'This field is required.',
        ]);

        $clg_courses = CollegeCourse::where('user_id',Auth::user()->id)->get();
        if(count($clg_courses) != 0){
            foreach ($clg_courses as $clg_course) { 
                if($id != $clg_course->id){
                    if($clg_course->qual_code == $request->qual_code){
                        $data['error'] = "1";
                    }
                }            
            } 
        }
       

        $qualCatgDesc = QualMast::where('qual_code',$request->qual_code)->first();
        $data['qual_catg_desc'] = $qualCatgDesc->qual_catg_desc;
        $data['qual_desc']      = $qualCatgDesc->qual_desc;
        return $data;
    }
}
