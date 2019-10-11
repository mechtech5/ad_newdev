<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseType;
use App\Models\CaseNotes;
use App\Models\CaseDetail;
use App\Models\CaseDoc;
use App\Models\CourtMast;
use App\Models\CaseStatusMast;
use App\Models\CatgMast;
use App\Helpers\Helpers;
class CaseDiaryController extends Controller
{
     public function __construct(){

    $this->middleware('auth');
    
  }
  
  public function index(){
    $caseBtn = Request()->caseBtn;

    $client_ids = Helpers::deletedClients();
    $id =Auth::user()->id;
    $onCases = CaseMast::with('casetype','client')
                        ->where('case_mast.user_id',$id)
                        ->where('case_mast.case_status','cg')
                        ->whereNotIn('cust_id',$client_ids)
                        ->get();

    $winCases = CaseMast::with('casetype','client')
                          ->where('case_mast.user_id',$id)
                          ->where('case_mast.case_status','cw')
                          ->whereNotIn('cust_id',$client_ids)
                          ->get();

    $lostCases = CaseMast::with('casetype','client')
                          ->where('case_mast.user_id',$id)
                          ->where('case_mast.case_status','cl')
                          ->whereNotIn('cust_id',$client_ids)
                          ->get();

    $allcase = CaseMast::with('casetype','client')->where('case_mast.user_id',$id)->whereNotIn('cust_id',$client_ids)->get();

    $courts = CourtMast::all();
    $clients = Customer::where('user_id',Auth::user()->id)->where('status_id','A')->get();
    $caseTypes = CaseType::all();
    $categories = CatgMast::all();
   return view('case.case_diary.index',compact('onCases','winCases','lostCases','allcase','caseBtn','courts','clients','caseTypes','categories'));
  }

  public function show($id){
    $id = explode(',', $id);
    $case_id = $id[0];
    $caseBtn = $id[1];


    $case_detail= CaseMast::with('casetype','client')
                          ->where('case_id', $case_id)
                          ->first();
    $case_notes = CaseNotes::where('case_id', $case_id)->get();
    $case_hearings = CaseDetail::where('case_id',$case_id)->get();
    $case_docs = CaseDoc::where('case_id',$case_id)->get();
     
    return view('case.case_diary.show', compact('case_detail','case_notes','case_hearings','case_docs','caseBtn')); 


  }

  public function filter(Request $request){

    $s_date = explode("/",$request->startDate);
    $e_date = explode("/",$request->endDate);

    $from = $s_date[2]."-".$s_date[1]."-".$s_date[0];
    $to = $e_date[2]."-".$e_date[1]."-".$e_date[0];

    $client_ids = Helpers::deletedClients();      
    $id = Auth::user()->id;

    $case_number  = $request->case_number;
    $court_code   = $request->case_court;
    $client_id    = $request->client_id; 
    $caseBtn      = $request->caseBtn;
    $case_type_id = $request->case_type_id;
    $catg_code    = $request->catg_code;
    $subcatg_code = $request->subcatg_code;

    
      $query = CaseMast::with('casetype','client')
                      ->where('case_mast.user_id',$id)
                      ->whereNotIn('cust_id',$client_ids)
                      ->whereBetween('case_reg_date',[$from,$to]);
      if($caseBtn == 'ca'){
        $query = $query;
      }else{
        $query = $query->where('case_mast.case_status',$caseBtn);
      }


    if($case_number == '' && $court_code == 0  && $client_id == 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0 ){
            $allcase = $query;
    }
    else{
      if($case_number == '' && $court_code == 0 && $client_id != 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('cust_id',$client_id);    

      }
      else if($case_number == '' && $court_code != 0 && $client_id == 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code',$court_code);     

      }
      else if($case_number != '' && $court_code == 0 && $client_id == 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number);

      }
      else if($case_number == '' && $court_code == 0 && $client_id == 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('case_type_id',$case_type_id);    

      }
      else if($case_number == '' && $court_code == 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code == 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('catg_code',$catg_code)->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id == 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code',$court_code)->where('case_number',$case_number); 

      }
      else if($case_number != '' && $court_code == 0 && $client_id != 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('cust_id',$client_id)->where('case_number',$case_number); 

      }
      else if($case_number == '' && $court_code != 0 && $client_id != 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase  = $query->where('cust_id',$client_id)->where('court_code',$court_code); 
        
      }
      else if($case_number == '' && $court_code == 0 && $client_id != 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('cust_id',$client_id)->where('case_type_id',$case_type_id);
       
      }
      else if($case_number == '' && $court_code != 0 && $client_id == 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('case_type_id',$case_type_id)->where('court_code',$court_code);
        
      }
      else if($case_number != '' && $court_code == 0 && $client_id == 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('case_type_id',$case_type_id)->where('case_number',$case_number);

      }
      else if($case_number != '' && $court_code == 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number', $case_number)->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code != 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code', $court_code)->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code == 0 && $client_id != 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('cust_id', $client_id)->where('catg_code',$catg_code);


      }
      else if($case_number == '' && $court_code == 0 && $client_id == 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_type_id', $case_type_id)->where('catg_code',$catg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id != 0 && $case_type_id == 0 && $catg_code == 0 && $subcatg_code == 0){
        
        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('cust_id',$client_id);

      }
      else if($case_number != '' && $court_code != 0 && $client_id == 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){
        $allcase  = $query->where('case_number',$case_number)
                            ->where('court_code',$court_code)
                            ->where('case_type_id',$case_type_id);

      }
      else if($case_number != '' && $court_code == 0 && $client_id != 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){
        
        $allcase = $query->where('case_number',$case_number)
                            ->where('cust_id',$client_id)
                            ->where('case_type_id',$case_type_id);
      }
      else if($case_number == '' && $court_code != 0 && $client_id != 0 && $case_type_id != 0 && $catg_code == 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code',$court_code)
                          ->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id);

      }
      else if($case_number != '' && $court_code != 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code != 0 && $client_id != 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code',$court_code)
                          ->where('cust_id',$client_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code == 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number != '' && $court_code == 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number == '' && $court_code != 0 && $client_id == 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('court_code',$court_code)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number == '' && $court_code == 0 && $client_id != 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('cust_id',$client_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number == '' && $court_code == 0 && $client_id == 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id != 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('client_id',$client_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code != 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('court_code',$court_code)
                          ->where('client_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number != '' && $court_code == 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('client_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id == 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code == 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code);

      }
      else if($case_number == '' && $court_code != 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('court_code',$court_code)
                          ->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code == 0 && $client_id != 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id == 0 && $case_type_id != 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id != 0 && $case_type_id == 0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)
                          ->where('cust_id',$cust_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code);

      }
      else if($case_number != '' && $court_code != 0 && $client_id != 0 && $case_type_id !=0 && $catg_code != 0 && $subcatg_code != 0){

        $allcase = $query->where('case_number',$case_number)
                          ->where('court_code',$court_code)   
                          ->where('cust_id',$client_id)
                          ->where('case_type_id',$case_type_id)
                          ->where('catg_code',$catg_code)
                          ->where('subcatg_code',$subcatg_code); 
      } 
      else{
        $allcase = array();
      }

    }

     
    if($caseBtn == 'cg'){
      $onCases = $allcase->get();
      return view('case.case_diary.table.on_going_case',compact('onCases'));
    }
    else if($caseBtn == 'cw'){
      $winCases = $allcase->get();
      return view('case.case_diary.table.win_case',compact('winCases','caseBtn'));
    }
    else if($caseBtn == 'cl'){
      $lostCases = $allcase->get();
      return view('case.case_diary.table.lost_case',compact('lostCases','caseBtn'));
    }
    else{
      $allcase = $allcase->get();
      return view('case.case_diary.table.all_case',compact('allcase','caseBtn'));
    }
  }
}
