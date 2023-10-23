<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\user_details;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    function userList(){
      
            $data['users']=DB::table('users')->where('register_type',2)->orderBy('user_id', 'DESC')
            ->paginate(25);
// dd($data['users']);
            return view('admin/user-list', $data);
       
    }
    function userAdmin(){
      
            $data['users']=DB::table('users')->where('register_type',1)->orderBy('user_id', 'DESC')
            ->paginate(25);
// dd($data['users']);
            return view('admin/admin-user', $data);
       
    }
    function userallDetails($user_id){
        // dd('ok');
        $data['users']=DB::table('users')->where('user_id',$user_id)->where('register_type',2)->get();
        $data['pronouns']=DB::table('pronouns')->get();
        $data['groups']=DB::table('groups')->get();
        $data['countries']=DB::table('countries')->get();
        $data['languages']=DB::table('languages')->get();
        // dd($data['users']);
                return view('admin/user-details',$data);
    }
    function userDetails(){
        $data['users']=DB::table('users')->where('register_type',2)->orderBy('user_id', 'DESC')->where('status','!=',3)
        ->paginate(25);

        return view('admin/all-users-list', $data);
    }
    function editUsers($id){
        
        $data['olddata']=DB::table('users')
        ->leftJoin('languages','users.language_id','=','languages.language_id')
        ->leftJoin('countries','users.country_id','=','countries.country_id')
        ->where('user_id',$id)
        ->first();
        $data['users']=DB::table('users')->where('register_type',2)->get();
        $data['country']=DB::table('countries')->get();
        $data['groups']=DB::table('groups')->get();
        $data['language']=DB::table('languages')->get();
        $data['pronouns']=DB::table('pronouns')->get();
        // dd($data['olddata']);
        return view('admin/edit-users',$data);
    }
    function updateUsers(Request $req){
        try {
            // dd($req->all());
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'dob' => 'required',
            'country_id'=>'required',
            'user_notification_status'=>'required',
            'data_security_accepted'=>'required',
            'is_term'=>'required',
            'is_social'=>'required',
            'google_cal_synced_status'=>'required',
            'language_id'=>'required',
            'period_day'=>'required',
            'average_cycle_length'=>'required',
            'average_cycle_days'=>'required',
            'package_expiry_date'=>'required',
            'package_start_date'=>'required',
            'description' => 'required|string|max:255',
            'status' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect('/admin/edit-users/'.$req->user_id)
                            
                ->withErrors($validator)
                ->withInput();
        }
         else {
            DB::table('users')->where('user_id', $req->user_id)
            ->update(array(
              'name'=>$req->name,
              // 'email'=>$req->email,
              'dob'=>$req->dob,
              'status' => $req->status,
              'user_notification_status'=>$req->user_notification_status,
              'weight'=>$req->weight,
              'height'=>$req->height,
              'image'=>$req->image,
              'description'=>$req->description,
              'country_id'=>$req->country_id,
              'is_term'=>$req->is_term,
              'data_security_accepted'=>$req->data_security_accepted,
              'is_social'=>$req->is_social,
              'is_understand'=>$req->is_understand,
              'google_cal_synced_status'=>$req->google_cal_synced_status,
              'focus_id'=>$req->focus_id,
              'language_id'=>$req->language_id,
              'period_day'=>$req->period_day,
              'average_cycle_length'=>$req->average_cycle_length,
              'average_cycle_days'=>$req->average_cycle_days,
              'package_expiry_date'=>$req->package_expiry_date,
              'package_start_date'=>$req->package_start_date,
            ));
            if (isset($req->image)) {
              
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'image'=>$req->image,
                    ));
                  
                
            }
            if(isset($req->gender) && isset($req->custom_gender)){
              
                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Only One  Gender & Custom Gender Fields ');
            } elseif(!isset($req->gender) && !isset($req->custom_gender)){

                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Atleast One  Gender & Custom Gender Fields');
            } else {
                if(isset($req->gender) && !isset($req->custom_gender)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'gender'=>$req->gender,
                    ));
                } 
                if(!isset($req->gender) && isset($req->custom_gender)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'custom_gender'=>$req->custom_gender,
                    )); 
                } 
            }
            if(isset($req->pronoun_name) && isset($req->custom_pronoun)){
              
                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Only One  Pronouns & Custom Pronouns Fields ');
            } elseif(!isset($req->pronoun_name) && !isset($req->custom_pronoun)){

                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Atleast One  Pronouns & Custom Pronouns Fields');
            } else {
                if(isset($req->pronoun_name) && !isset($req->custom_pronoun)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'pronoun_id'=>$req->pronoun_id,
                    ));
                } 
                if(!isset($req->pronoun_name) && isset($req->custom_pronoun)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'custom_pronoun'=>$req->custom_pronoun,
                    )); 
                } 
            }
            if(isset($req->group_id) && isset($req->custom_group)){
              
                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Only One  Groups & Custom Groups Fields ');
            } elseif(!isset($req->group_id) && !isset($req->custom_group)){

                return redirect('/admin/edit-users/'.$req->user_id)->with('message','Please Select Atleast One  Groups & Custom Groups Fields');
            } else {
                if(isset($req->group_id) && !isset($req->custom_group)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'group_id'=>$req->group_id,
                    ));
                } 
                if(!isset($req->group_id) && isset($req->custom_group)){
                    DB::table('users')->where('user_id', $req->user_id)
                    ->update(array(
                      'custom_group'=>$req->custom_group,
                    )); 
                } 
            }
           
              
      return redirect('/admin/all-users-list')->with('success','User Updated Successfully!');
            }
     } catch (\Exception $exception) {
                 $data['error'] = $exception->getMessage();
                    return view('error', $data);
     }
    }
    
function deleteUsers($user_id){

    DB::table('users')->where('user_id', $user_id)
            ->update(array(
              
              'status' => 3,
              
            ));
    return redirect('admin/user-list')->with('success','User Archived Successfully!');
}
function userAchived(){
    $data['users']=DB::table('users')->where('register_type',2)->orderBy('user_id', 'DESC')->where('status',3)
    ->paginate(25);
// dd($data['users']);
    return view('admin/archived-user', $data);
}
function undoUsers($user_id){
    DB::table('users')->where('user_id', $user_id)
    ->update(array(
      
      'status' => 1,
      
    ));
return redirect('admin/user-list')->with('success','User Active Successfully!');
}
}
