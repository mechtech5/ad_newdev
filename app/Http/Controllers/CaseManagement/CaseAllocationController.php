<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\CaseMast;
use App\Models\CaseLawyer;
use App\Models\Customer;
use App\Helpers\Helpers;
class CaseAllocationController extends Controller
{
    public function __construct(){

      $this->middleware('auth');

    }

    public function index(){
        $client_ids = Helpers::deletedClients();
        $id =Auth::user()->id;
        $onCases = CaseMast::with('casetype','client')->where('case_mast.user_id',$id)->where('case_mast.case_status','cg')->whereNotIn('cust_id',$client_ids)->get();
        
        return view('case_allocation.show',compact('onCases'));
    }

    public function create(Request $request){
        $case_id = $request->case_id;

        $caseDetails = CaseMast::with('casetype')->where('case_id',$case_id)->get();

        $alloc_lawyers = CaseLawyer::where('case_id',$case_id)->whereNull('deallocate_date')->get();    

        $alloc_lawyer_ids = array();
        foreach ($alloc_lawyers as $alloc_lawyer) {
             $alloc_lawyer_ids[] =  $alloc_lawyer->user_id1;
        }        
        
        $dealloc_lawyers = CaseLawyer::where('case_id',$case_id)->whereNotNull('deallocate_date')->get();

        $dealloc_lawyer_ids = array();
        foreach ($dealloc_lawyers as $dealloc_lawyer) {
             $dealloc_lawyer_ids[] =  $dealloc_lawyer->user_id1;
        }

        $alloc_dealloc_ids =array_merge($alloc_lawyer_ids,$dealloc_lawyer_ids);


        if(count($alloc_dealloc_ids)!=0){

           $comp_lawyers = User::where('parent_id',Auth::user()->id)->whereNotIn('id',$alloc_lawyer_ids)->get();
        }
        else{
           $comp_lawyers = User::where('parent_id',Auth::user()->id)->get();  
        }


        $allocate_lawyers = User::where('parent_id',Auth::user()->id)->whereIn('id',$alloc_lawyer_ids)->get();

        $deallocate_lawyers = User::where('parent_id',Auth::user()->id)->whereIn('id',$dealloc_lawyer_ids)->get(); 

         // return $allocate_lawyers;

        return view('case_allocation.create',compact('caseDetails','case_id','comp_lawyers','allocate_lawyers','deallocate_lawyers'));
    }

    public function store(Request $request){
        $data = $request->validate([
        'user_id1'  => 'required|not_in:0',
        'allocate_date'=> 'required',
        'user_id'   => 'required',
        'case_id'   => 'required',
        ]);
        
        CaseLawyer::insert($data);
        return redirect()->back()->with('success', 'Lawyer allocated for this case');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      
    }

    public function update(Request $request, $id)
    {
        $data= $request->validate([
            'user_id1' => 'required|not_in:0', 
            'allocate_date' => 'required', 
            'deallocate_date' => 'required', 
            'remark' => 'required', 
            'case_id' => 'required', 
            'user_id' => 'required', 
        ]);

        if($data['allocate_date'] >= $data['deallocate_date']){
            return redirect()->back()->with('warning', 'Allocate date and deallocate date are not same and less than ');
        }

        CaseLawyer::where('case_id',$request->case_id)->where('user_id1',$request->user_id1)->update($data);
        return redirect()->back()->with('success', 'Lawyer deallocated for this case');
    }

    public function destroy($id)
    {
       
    }
    public function allocate_lawyer(Request $request){
        $user_id1 =  $request->user_id1;
        $case_id = $request->case_id;
        $lawyerDetails = CaseLawyer::where('case_id',$case_id)->where('user_id1',$user_id1)->first();
        return $lawyerDetails->allocate_date;
    }   
}
