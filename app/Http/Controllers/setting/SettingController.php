<?php

namespace App\Http\Controllers\setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings;
use App\Models\cms;


class SettingController extends Controller
{
    function UploadSetting(){
        try {
            $settings = DB::table('settings')->get();
            $bind_settings = array();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            $data['bind_settings'] = $bind_settings;
            return view('setting/upload-setting', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }

    }
    function saveSetting(Request $req){

        try {
            foreach ($req->setting as $key => $setting) {
                $Setting = new Settings;
                $Setting->key = $key;
                $Setting->value = $setting;
                $Setting->save();
            }
            return redirect('setting/upload-setting');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function editior(){
        return view('editior/editior-create');
    }
    function saveEditior(Request $req){
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'short_description' => 'required',
            'long_description'=>'required',
            'slug'=>'required',
            'status'=>'required',
        ]);

        if ($validator->fails()) {

            return redirect('editior/editior-create')
                            
                ->withErrors($validator)
                ->withInput();
         }else{
                $cms = new cms;
                $cms->title = $req->title;
                $cms->short_description = $req->short_description;
                $cms->long_description =$req->long_description;
                $cms->slug =$req->slug;
                $cms->status =$req->status;
                $cms->save();
               
                return redirect('/editior/list-editior')->with('success','Page Added Sucessfully');
            }
        }
            // return redirect('setting/upload-setting');
      function ListEditior(){
        $data['cms'] = DB::table('cms')->orderBy('title', 'ASC')
        ->paginate(25);
        return view('/editior/list-editior', $data);
      }
      function ViewEditior($id){
        $data['long_description']= DB::table('cms')->where('id', $id)
        ->select('long_description')
        ->first();
        // dd($data['cms']);
        return view('/editior/view-editior',$data);
      }
      function DeleteEditior($id){
        cms::where('id', $id)
        ->update([
            'status' => 3
         ]);
         return redirect('/editior/list-editior')->with('success','CMS Page Deleted Sucessfully');
      }
      function EditEditior($id){
        // dd('okk');
        $data['cms']= DB::table('cms')->where('id', $id)
        ->first();
           return view('/editior/edit-editior',$data);
      }
      function UpdateEditior(Request $req){
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'short_description' => 'required',
            'long_description'=>'required',
            'slug'=>'required',
            'status'=>'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                            
                ->withErrors($validator)
                ->withInput();
         }else{
        cms::where('id', $req->id)
        ->update([
            'title' => $req->title,
            'short_description' => $req->short_description,
            'long_description'=>$req->long_description,
            'slug'=>$req->slug,
            'status'=>$req->status,
         ]);
         return redirect('/editior/list-editior')->with('success','CMS Page Updated Sucessfully');
      }

    }

    }


