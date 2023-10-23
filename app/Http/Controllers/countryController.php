<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use App\Models\countries;
use Illuminate\Http\Request;

class countryController extends Controller
{
    function createCountry(){
        return view('/country/country-create');
    }
    function SaveCountry(Request $req){
        try{
            // dd($req->all());
        $validator = Validator::make($req->all(), [
            'country_name'=>'required|string',
            'country_code'=>'required|string',
        ]);

        if ($validator->fails()) {
         
            return redirect('/country/country-create')
                ->withErrors($validator)
                ->withInput();
        } else {
          
                $countries = new countries;
                $countries->country_name=ucfirst($req->country_name);
                $countries->country_code=strtoupper($req->country_code);
                $countries->save();  
                return redirect('/country/country-list')->with('success', 'New Country added List Successfully');         
    }
  
   
    
} catch (\Exception $exception) {
    $data['error'] = $exception->getMessage();
    return view('error', $data);
}
}
function ListCountry(){
    try {
        $data['countries'] = DB::table('countries')->orderBy('country_id', 'DESC')
        ->paginate(25);
    
        return view('country/country-list',$data);
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}
function DeleteCountry($country_id){
    try {
        $countries = DB::table('countries')
            ->where('country_id', $country_id )
            ->delete();
        return redirect('/country/country-list');
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}
function EditCountry($country_id){
    try {
        $data['countries'] = DB::table('countries')
        ->where('country_id', $country_id )
        ->first();
        // dd($data['moonphases']);
    return view('/country/edit-country',$data);
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
   
}
function UpdateCountry(Request $req){
    try {
        $validator = Validator::make($req->all(), [
            'country_name'=>'required|string',
            'country_code'=>'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect('/country/edit-country/'.$req->id)
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::table('countries')->where('country_id', $req->id)
            ->update(
                array(
                    'country_name'=>$req->country_name,
                    'country_code'=>$req->country_code,
                    
                )
            );
            return redirect('/country/country-list')->with('success', 'Country Updated Successfully!');
        }
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}
}
