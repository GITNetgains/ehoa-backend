<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coupens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class CoupensController extends Controller
{
    function coupensCreate(){
    return view('coupens/coupens-create');
    }
    function coupensSave(Request $req){
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'description'=>'required|max:255',
            'coupon'=>'required|integer',
            'expiry'=>'required',
            'used_number_of_times'=>'required|integer',
            'status' =>'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect('/coupens/coupens-create')
                ->withErrors($validator)
                ->withInput();
        } else {
           
                $coupens = new coupens;
                $coupens->name=$req->name;
                $coupens->description=$req->description;
                $coupens->coupon=$req->coupon;
                $coupens->expiry=$req->expiry;
                $coupens->used_number_of_times=$req->used_number_of_times;
                $coupens->status=$req->status;
                $coupens->save();           
    }
  
    return redirect('/coupens/list-all-coupons')->with('success', 'New Coupons added List Successfully');
    
    }
    function coupensList(){
        try {
            $data['coupens'] = DB::table('coupens')->orderBy('coupons_id', 'DESC')->where('status','!=',3)
            ->paginate(25);
            // dd( $data['moonphases']);
            return view('coupens/list-all-coupons',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function coupensArichved(){
        try {
            $data['coupens'] = DB::table('coupens')->orderBy('coupons_id', 'DESC')->where('status',3)
            ->paginate(25);
            // dd( $data['moonphases']);
            return view('/coupens/archived-coupons',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function couponsDelete($coupons_id){
        try {
            DB::table('coupens')->where('coupons_id', $coupons_id)
        ->update(
            array(
              
                'status' => 3,

            )
        );
            return redirect('/coupens/list-all-coupons')->with('success','Coupons Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function coupensUndo($coupons_id){
        try {
            DB::table('coupens')->where('coupons_id', $coupons_id)
        ->update(
            array(
              
                'status' => 1,

            )
        );
            return redirect('/coupens/archived-coupons');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function couponsEdit($coupons_id){
        
        $data['coupens'] = DB::table('coupens')
            ->where('coupons_id', $coupons_id)
            ->first();
        return view('/coupens/edit-coupons', $data);
    }
    function coupensUpdate(Request $req){
        try {
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'description'=>'required|max:255',
            'coupon'=>'required|integer',
            'expiry'=>'required',
            'used_number_of_times'=>'required|integer',
            'status' =>'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect('/coupens/edit-coupons/'.$req->id)
                ->withErrors($validator)
                ->withInput();
        } else {
           
        DB::table('coupens')->where('coupons_id', $req->id)
        ->update(
            array(
                'name' => $req->name,
                'description' => $req->description,
                'coupon' => $req->coupon,
                'expiry' => $req->expiry,
                'used_number_of_times' => $req->used_number_of_times,
                'status' => $req->status,

            )
        );

        return redirect('/coupens/list-all-coupons')->with('success', 'Coupons Updated Successfully!');
    }
} catch (\Exception $exception) {
    $data['error'] = $exception->getMessage();
    return view('error', $data);
}
    }

    }

