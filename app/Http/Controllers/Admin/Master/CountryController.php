<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.dashboard.master.location.country.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.master.location.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);        
        return view('admin.dashboard.master.location.country.edit',compact('country'));
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
        $data = $this->validation($request);
        $country = Country::find($id); 
        $country->update($data);
        return redirect()->route('country.index')->with('success','Country Name Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        ]);
    }
}
