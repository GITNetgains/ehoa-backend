<?php

namespace App\Http\Controllers\admin;
use App\Models\yogas;
use App\Models\sub_yogas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class yogaController extends Controller
{
    function yogaCreate(){
        // $newpodcast = array();
        $yogaget = DB::table('yogas')->get();
        return view('admin/yoga-create', ['yogaget' => $yogaget] );

    }
    function yogaSave(Request $req){

        // try {
            $validator = Validator::make($req->all(), [
                'yoga_description' => ['max:255','required', 'string'],
                'yoga_additional_info' => ['max:255','required', 'string'],
                'yoga_image'=>['required'],
                'status'=>['required']
            ]);

            if ($validator->fails()) {

                return redirect('/admin/yoga-create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $file = $req->yoga_image;
                $file_name = $file->getClientOriginalName();
                $file_path = $file->getRealPath();
                $file_image_size = $file->getSize();
                $rl=$file_path;
                $sj=getimagesize($rl);
                $image_width=$sj[0];
                $image_height=$sj[1];
                $extension_image=$file->getClientOriginalExtension();
                $destinationPath = "storage/yogas_image";
                $original_name = strtolower(trim($req->yoga_image->getClientOriginalName()));
                $file_name = time() . rand(100, 999) . str_replace(' ', '-', $original_name);
                $file->move($destinationPath, $file_name);
                if ($req->parent_type == 0) {
                    $podcasts = new yogas;
                    $podcasts->yoga_description = $req->yoga_description;
                    $podcasts->yoga_additional_info = $req->yoga_additional_info;
                    $podcasts->parent_type = 0;
                    $podcasts->yoga_image = 'storage/yogas_image/'.$file_name;
                    $podcasts->status=$req->status;
                    // dd($podcasts);
                    $podcasts->save();
                } else {
                    $podcasts = new yogas;
                    $podcasts->yoga_description = $req->yoga_description;
                    $podcasts->yoga_additional_info = $req->yoga_additional_info;
                    $podcasts->parent_type = $req->parent_type;
                    $podcasts->yoga_image = 'storage/yogas_image/'.$file_name;
                    $podcasts->status=$req->status;
                    // dd($podcasts);
                    $podcasts->save();
                   }

                return redirect('/admin/list-all-yogas')->with('success', 'New Yogas added successfully');


                

            }
        // } catch (\Exception $exception) {
        //     $data['error'] = $exception->getMessage();
        //     return view('error', $data);
        // }
    }
    function yogaList(){
        
        try {
            $uniqid = array();
            $data['yogaget'] = DB::table('yogas')->get();
            foreach ($data['yogaget'] as $tp) {
                $uniqid[$tp->yoga_id] = array(
                    'parent_type'=>$tp->parent_type,
                    'yoga_description'=>$tp->yoga_description,
                    'yoga_additional_info' => $tp->yoga_additional_info,
                    'yoga_image' => $tp->yoga_image
                );
            }
            
            //   dd( $yogas);
            return view('admin/list-all-yogas', [ 'uniqueid' => $uniqid]);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function yogaDelete($id){
        try {
            $podcast = DB::table('yogas')
                ->where('yoga_id', $id)
                ->delete();
            return redirect('/admin/list-all-yogas');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
}
