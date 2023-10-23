<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\moonphases;
class MoonPhaseController extends Controller
{
    function CreateMoonphase(){
        return view('disorder/moonphase-create');
    }
    function SaveMoonPhase(Request $req){
        // dd('okk');
        $validator = Validator::make($req->all(), [
            'moon_phases_name'=>'required',
            'short_description'=>'required',
            'icon'=>'required|image|mimes:jpeg,jpg,bmp,png',
            'status' =>'required',
        ]);

        if ($validator->fails()) {
            return redirect('/disorder/moonphase-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_thumb = $req->icon;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl=$file_path_thumb;
            $sj=getimagesize($rl);
            $image_width_thumb=$sj[0];
            $image_height_thumb=$sj[1];
            $extension_image=$file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/moonphase-icons";
            $original_thub = strtolower(trim($req->icon->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
                $moonphases = new moonphases;
                $moonphases->moon_phases_name=$req->moon_phases_name;
                $moonphases->short_description=$req->short_description;
                $moonphases->icon='storage/moonphase-icons/'.$file_name_thumb;
                $moonphases->status=$req->status;
                $moonphases->save();           
    }
  
    return redirect('/disorder/list-all-moonphase')->with('success', 'New Moon Phases added List Successfully');
    }
    function ListMoonphase(){
        try {
            $data['moonphases'] = DB::table('moonphases')->orderBy('moon_phase_id', 'DESC')->where('status','!=',3)
            ->paginate(25);
            // dd( $data['moonphases']);
            return view('disorder/list-all-moonphase',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
      
    }
    function ArchivedMoonphase(){
        try {
            $data['moonphases'] = DB::table('moonphases')->orderBy('moon_phase_id', 'DESC')->where('status',3)
            ->paginate(25);
            // dd( $data['moonphases']);
            return view('disorder/archived-moonphase',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function DeleteMoonphase($moon_phase_id){
        try {
            DB::table('moonphases')->where('moon_phase_id', $moon_phase_id)
            ->update(
                array(
                 
                    'status' => 3,
                    
                )
            );
            return redirect('/disorder/list-all-moonphase')->with('success','Moon Phase Added Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function UndoMoonphase($moon_phase_id){
        try {
            DB::table('moonphases')->where('moon_phase_id', $moon_phase_id)
            ->update(
                array(
                 
                    'status' => 1,
                    
                )
            );
            return redirect('/disorder/archived-moonphase')->with('success','Moon Phase Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function EditMoonphase($moon_phase_id){
        $data['moonphases'] = DB::table('moonphases')
        ->where('moon_phase_id', $moon_phase_id )
        ->first();
        // dd($data['moonphases']);
    return view('/disorder/edit-moonphase',$data);
    }
    function UpdateMoonPhase(Request $req){
        $validator = Validator::make($req->all(), [
            'moon_phases_name'=>'required',
            'short_description'=>'required',
            'status' =>'required',
        ]);

        if ($validator->fails()) {
            return redirect('/disorder/edit-moonphase/'.$req->id)
                ->withErrors($validator)
                ->withInput();
        } else {

        if(isset($req->icon)){
            $validator = Validator::make($req->all(), [
                'icon'=>'required|image|mimes:jpeg,jpg,bmp,png',  
            ]);
    
            if ($validator->fails()) {
                return redirect('/disorder/edit-moonphase/'.$req->id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
            $file_thumb = $req->icon;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl=$file_path_thumb;
            $sj=getimagesize($rl);
            $image_width_thumb=$sj[0];
            $image_height_thumb=$sj[1];
            $extension_image=$file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/moonphase-icons";
            $original_thub = strtolower(trim($req->icon->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            // dd($file_name_thumb);
            $file_thumb->move($destinationPath, $file_name_thumb);
            DB::table('moonphases')->where('moon_phase_id', $req->id)
            ->update(
                array(
                    'icon' => 'storage/moonphase-icons/'.$file_name_thumb,   
                )
            );
            }}
            DB::table('moonphases')->where('moon_phase_id', $req->id)
            ->update(
                array(
                    'moon_phases_name'=>$req->moon_phases_name,
                    'short_description'=>$req->short_description,
                    'status' => $req->status,
                    
                )
            );
            return redirect('/disorder/list-all-moonphase')->with('success', 'Moon Phases Updated Successfully!');
    }}
}
