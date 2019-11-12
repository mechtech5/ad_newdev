<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QualCatg;
class StudentDetailController extends Controller
{
    public function index(){
    	return view('student.student_detail.index');
    }
    public function create(){
        $qual_catgs = QualCatg::where('qual_catg_code', '!=',4)->get();
       
    	return view('student.student_detail.create',compact('qual_catgs'));
    }
    public function store(Request $request){
    	
        return $request->all();
			foreach ($request->qual_name as $value) {
                if($value != null){
                    $true[] = $value; 
                }
            }
            return $true;
    	
    }
}
