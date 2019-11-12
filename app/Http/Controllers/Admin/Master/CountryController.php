<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Currency;
class CountryController extends Controller
{
 
    public function index()
    {
        $countries = Country::with('nationality','currency')->get();
        return view('admin.dashboard.master.location.country.index',compact('countries'));
    }

  
    public function create()
    {
        $nationalities = Nationality::all();
        $currencies = Currency::all();
        return view('admin.dashboard.master.location.country.create',compact('currencies','nationalities'));
    }
 
    public function store(Request $request)
    {
        $data = $this->validation($request);
        $countries = Country::all();

        if(count($countries) !=0){
            foreach ($countries as $value) {
                $data['country_code'] =  $value->country_code + 1 ;
            }
        }
        else{
            $data['country_code'] = '1';
        }

        Country::create($data);
        return redirect()->route('country.index')->with('success','Country Name Inserted Successfully');
    }

   
    public function edit($id)
    {
        $country = Country::find($id);   
        $nationalities = Nationality::all();
        $currencies = Currency::all();     
        return view('admin.dashboard.master.location.country.edit',compact('country','currencies','nationalities'));
    }

 
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $country = Country::find($id); 
        $country->update($data);
        return redirect()->route('country.index')->with('success','Country Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        $country = Country::find($id)->delete();
        return redirect()->back()->with('success','Country Name Deleted Successfully');
    }

    public function validation($request){
        return $request->validate([
            'country_name'  => 'required|string|max:80|min:3',
             'phone_code'   => 'nullable|string|max:10|min:1|regex:/^[0-9]+$/',
             'iso2'         => 'nullable|string|max:2|min:2',
             'iso3'         => 'nullable|string|max:3|min:3',
             'nationality_id'  => 'nullable',
             'currency_code'=> 'nullable'
        ]);
    }
}
