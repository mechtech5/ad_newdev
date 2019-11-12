<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Helpers\Helpers;
class CurrencyController extends Controller
{
    public function index(){
        $currencies = Currency::all(); 
        return view('admin.dashboard.master.currency.index',compact('currencies'));
    }
    public function create(){
        return view('admin.dashboard.master.currency.create');
    }
    public function store(Request $request){

        $data = $request->validate([
            'currency_code' => 'required|string|regex:/^[a-zA-Z]+$/u|max:3|min:2|unique:currency',
            'currency_name' => 'required|string|max:50|min:1|regex:/^[a-zA-Z]+$/u',
            'symbol' => 'nullable|min:1|max:4',
        ]);

        Currency::create($data);
        return redirect()->route('currency.index')->with('success', 'Currency Inserted Successfully');
    }
    public function edit($id){

        $currency = Currency::where('currency_code',$id)->first();

        return view('admin.dashboard.master.currency.edit', compact('currency'));
    }
    public function update(Request $request,$id){

        $data = $request->validate([
            'currency_code' => 'required|string|regex:/^[a-zA-Z]+$/u|max:3|min:2||unique:currency,currency_code,'.$id.',currency_code',
            'currency_name' => 'required|string|max:50|min:1|regex:/^[a-zA-Z]+$/u',
            'symbol' => 'nullable|min:1|max:4',
        ]);
    

        Currency::where('currency_code',$id)->update($data);
        return redirect()->route('currency.index')->with('success', 'Currency Updated Successfully');
    }
    public function destroy($id){
      
        Currency::where('currency_code',$id)->delete();
        return redirect()->back()->with('success', 'Currency Deleted Successfully');
    }
}
