<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\mood_disorders;

class moodDisordersController extends Controller
{
    function CreateDisorder()
    {

        return view('disorder/disorders-create');
    }
    function SaveDisorder(Request $req){
       if(isset($req->primary)){
        $subtotalcount = DB::table('mood_disorders')->where('primary','=',$req->primary)->where('disorders_type','=',3)->where('status','=',1)->count('primary');
        // $statusdelete = DB::table('mood_disorders')->where('disorders_type',3)->orWhere('primary',$req->primary)->orWhere('status',3)->get();
        // dd($subtotalcount);
        if($subtotalcount< 6){
            $validator = Validator::make($req->all(), [
                'disorders_type' => 'required',
                'name' => 'required',
                'icon' => 'required|image|mimes:jpeg,jpg,bmp,png',
                'primary'=>'required',
                'status' => 'required',
            ]);
          
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                    
                }
            else
            {
                $file_thumb = $req->icon;
                $file_name = $file_thumb->getClientOriginalName();
                $file_path_thumb = $file_thumb->getRealPath();
                $file_image_size = $file_thumb->getSize();
                $rl = $file_path_thumb;
                $sj = getimagesize($rl);
                $image_width_thumb = $sj[0];
                $image_height_thumb = $sj[1];
                $extension_image = $file_thumb->getClientOriginalExtension();
                $destinationPath = "storage/icons";
                $original_thub = strtolower(trim($req->icon->getClientOriginalName()));
                $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                $file_thumb->move($destinationPath, $file_name_thumb);
                $mood_disorders = new mood_disorders;
                $mood_disorders->disorders_type = $req->disorders_type;
                $mood_disorders->name = $req->name;
                $mood_disorders->icon = 'storage/icons/' . $file_name_thumb;
                $mood_disorders->primary = $req->primary;
                $mood_disorders->status = $req->status;
                // dd($mood_disorders);
                $mood_disorders->save();
                return redirect('/disorder/list-emotions')->with('success', 'New Emotions added List Successfully');

        }
    }
        if($subtotalcount==6){
           
                return redirect('/disorder/emotions-create/emotions')->with('error', 'Your Are Added Only Six Primary Emotions ');    
    }}
       else{
        $validator = Validator::make($req->all(), [
                    'disorders_type' => 'required',
                    'name' => 'required',
                    'icon' => 'required|image|mimes:jpeg,jpg,bmp,png',
                    'status' => 'required',
                ]);
              
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                        
                    }
                else
                {
                    $file_thumb = $req->icon;
                    $file_name = $file_thumb->getClientOriginalName();
                    $file_path_thumb = $file_thumb->getRealPath();
                    $file_image_size = $file_thumb->getSize();
                    $rl = $file_path_thumb;
                    $sj = getimagesize($rl);
                    $image_width_thumb = $sj[0];
                    $image_height_thumb = $sj[1];
                    $extension_image = $file_thumb->getClientOriginalExtension();
                    $destinationPath = "storage/icons";
                    $original_thub = strtolower(trim($req->icon->getClientOriginalName()));
                    $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                    $file_thumb->move($destinationPath, $file_name_thumb);
                    $mood_disorders = new mood_disorders;
                    $mood_disorders->disorders_type = $req->disorders_type;
                    $mood_disorders->name = $req->name;
                    $mood_disorders->icon = 'storage/icons/' . $file_name_thumb;
                    $mood_disorders->primary = 'not primary';
                    $mood_disorders->status = $req->status;
                    // dd($mood_disorders);
                    $mood_disorders->save();
                    // return redirect('/disorder/list-all-disorders')->with('success', 'New Disorder added List Successfully');
                        
                    if($req->disorders_type==1){
                        return redirect('/disorder/list-menstrual')->with('success', 'New Menstrual added List Successfully');
                    }
                   elseif($req->disorders_type==2){
                    return redirect('/disorder/list-symtoms')->with('success', 'New Symtoms added List Successfully');
                   }
                   elseif($req->disorders_type==3){
                    return redirect('/disorder/list-emotions')->with('success', 'New Emotions added List Successfully');
                   }
                   elseif($req->disorders_type==4){
                    return redirect('/disorder/list-energy')->with('success', 'New Energy added List Successfully');
                   }
       
       
        }
    }
}

        
    // }
    // function ListDisorder()
    // {
    //     try {
    //         $data['mood_disorders'] = DB::table('mood_disorders')->get();
    //         return view('disorder/list-all-disorders', $data);
    //     } catch (\Exception $exception) {
    //         $data['error'] = $exception->getMessage();
    //         return view('error', $data);
    //     }

    // }
    function EditDisorder($disorders_id)
    {
        $data['mood_disorders'] = DB::table('mood_disorders')
            ->where('disorders_id', $disorders_id)
            ->first();
        // dd($data['mood_disorders']);
        
        return view('/disorder/edit-disorder', $data);
    }
    function UpdateDisorder(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
      
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
                
            }
        else{
            
                if(isset($req->primary)){
                    $subtotalcount = DB::table('mood_disorders')->where('primary','=',$req->primary)->where('disorders_type','=',3)->where('status','=',1)->count('primary');
                    if($subtotalcount<6){
                        DB::table('mood_disorders')->where('disorders_id', $req->id)
                        ->update(
                            array(
                                'primary' => $req->primary,
                            )
                        );
                     
                            return redirect('/disorder/list-emotions')->with('success', 'New Emotions Updated Successfully!');
                }
                if($subtotalcount==6)
                return redirect('/disorder/edit-disorder/'.$req->id)->with('error', 'Your Are Added Only Six Primary Emotions '); 
                    }
            
            
          
            
        if (isset($req->icon)) {
            $validator = Validator::make($req->all(), [
                'icon' => 'required|image|mimes:jpeg,jpg,bmp,png',
            ]);
          
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                    
                }
            else{

            $file_thumb = $req->icon;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/icons";
            $original_thub = strtolower(trim($req->icon->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
            DB::table('mood_disorders')->where('disorders_id', $req->id)
                ->update(
                    array(
                        'icon' => 'storage/icons/' . $file_name_thumb,
                    )
                );
        }}
        DB::table('mood_disorders')->where('disorders_id', $req->id)
            ->update(
                array(
                    'disorders_type' => $req->disorders_type,
                    'name' => $req->name,
                    'status' => $req->status,
                    'primary' => 'not primary',
                )
            );
            if($req->disorders_type==1){
                return redirect('/disorder/list-menstrual')->with('success', 'New Menstrual Updated Successfully!');
            }
           elseif($req->disorders_type==2){
            return redirect('/disorder/list-symtoms')->with('success', 'New Symtoms Updated Successfully!');
           }
           elseif($req->disorders_type==3){
            return redirect('/disorder/list-emotions')->with('success', 'New Emotions Updated Successfully!');
           }
           elseif($req->disorders_type==4){
            return redirect('/disorder/list-energy')->with('success', 'New Energy Updated Successfully!');
           }
        }
    }
    function DeleteEmotions($disorders_id)
    {
        // dd($disorders_id);
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>3,

                )
            );
            return redirect('/disorder/list-emotions')->with('success','Emotions Successfully Archived ');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function DeleteEnergy($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>3,

                )
            );
            return redirect('/disorder/list-energy')->with('success','Energy Added Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function undo($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>1,
                    'primary'=>'not primary',
                )
            );
            return redirect('/disorder/archived')->with('success','Emotion Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        } 
    }
    function DeleteSymtoms($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>3,

                )
            );
            return redirect('/disorder/list-symtoms')->with('success','Symtoms Added Archived Successfully ');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function DeleteMenstrual($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>3,

                )
            );
            return redirect('/disorder/list-menstrual')->with('success','Menstrual Added  Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function UndoMenstrual($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>1,

                )
            );
            return redirect('/disorder/archived-menstrual')->with('success','Menstrual Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function CreateMenstrual($menstrual)
    {
        // dd($menstrual);
        $data['menstrual'] = $menstrual;
        // dd($data['menstrual']);
        return view('disorder/disorders-create', $data);
    }
    function CreateSymptoms($symptoms)
    {
        $data['symptoms'] = $symptoms;
        // dd($data['menstrual']);
        return view('disorder/disorders-create', $data);
    }
    function CreateEmotions($emotions)
    {
        $data['emotions'] = $emotions;
        // dd($data['menstrual']);
        return view('disorder/disorders-create', $data);
    }
    function CreateEnergy($energy)
    {
        $data['energy'] = $energy;
        // dd($data['menstrual']);
        return view('disorder/disorders-create', $data);
    }
    function ListMenstrual(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',1)->orderBy('disorders_type', 'DESC')->where('status','!=',3)
            ->paginate(25);
            return view('/disorder/list-menstrual', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
      
    }
    function ArchivedMenstrual(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',1)->orderBy('disorders_type', 'DESC')->where('status',3)
            ->paginate(25);
            return view('/disorder/archived-menstrual', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function ListSymtoms(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',2)->orderBy('disorders_type', 'DESC')->where('status','!=',3)
            ->paginate(25);
            return view('/disorder/list-symtoms', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
       
    }
    function ArchivedSymtoms(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',2)->orderBy('disorders_type', 'DESC')->where('status',3)
            ->paginate(25);
            return view('/disorder/archived-symtoms', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function UndoSymtoms($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>1,

                )
            );
            return redirect('/disorder/archived-symtoms')->with('success','Symtoms  Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
      
    }
    function ListEmotions(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',3)->orderBy('disorders_type', 'DESC')->where('status','!=',3)
            ->paginate(25);
            $data['count']=DB::table('mood_disorders')->where('disorders_type',3)->where('primary', 'primary')->where('status',1)->count('primary');
        //   dd($data['count']);
            return view('/disorder/list-emotions', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
      
    }
    function ListEnergy(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',4)->orderBy('disorders_type', 'DESC')->where('status','!=',3)
            ->paginate(25);
            return view('/disorder/list-energy', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
      
    }
    function achivedEnergy(){
        try {
            $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type',4)->orderBy('disorders_type', 'DESC')->where('status',3)
            ->paginate(25);
            return view('/disorder/archived-energy', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function achived(){
        $data['deleted'] = DB::table('mood_disorders')->where('disorders_type',3)->orderBy('disorders_type', 'DESC')->where('status',3)
        ->paginate(25);
       return view('disorder/archived',$data);
    }
    function UndoEnergy($disorders_id){
        try {
            DB::table('mood_disorders')->where('disorders_id',$disorders_id)
            ->update(
                array(
                    'status' =>1,

                )
            );
            return redirect('/disorder/archived-energy')->with('success','Energy  Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
}