<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Models\tips;
use App\Models\sub_tips;
use App\Models\podcasts;
use App\Models\videos;
use App\Models\yogas;
use App\Models\blogs;
use App\Models\discounts;
use App\Models\packages;
use App\Models\package_details;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Owenoj\LaravelGetId3\GetId3;

class PackageController extends Controller
{
    function Package()
    {
        try {
            return view('admin/package');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function savePackage(Request $req)
    {
        //    dd($req->all());
        try {
            $validator = Validator::make($req->all(), [
                'package_title' => ['required', 'string', 'max:255'],
                'package_description' => ['required', 'string', 'max:255'],
                'price' => ['required', 'numeric'],
                'package_expiry' => ['required'],
                'package_type' => ['required'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                // dd('ok');
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (isset($req->tip_enabled) || isset($req->video_enabled) || isset($req->blog_enabled) || isset($req->podcast_enabled) || isset($req->movements_enabled) ||  isset($req->log_sharing_enabled) ||  isset($req->cycle_length_report_enabled) || isset($req->mood_report_enabled) || isset($req->energy_report_enabled) || isset($req->general_report_enabled)) {


                    if (isset($req->tip_enabled) && $req->tip_enabled == 1) {
                        $tip_enabled = 1;
                    } else {
                        $tip_enabled = 0;
                    }
                    if (isset($req->video_enabled) && $req->video_enabled == 1) {
                        $video_enabled = 1;
                    } else {
                        $video_enabled = 0;
                    }
                    if (isset($req->blog_enabled) && $req->blog_enabled == 1) {
                        $blog_enabled = 1;
                    } else {
                        $blog_enabled = 0;
                    }
                    if (isset($req->podcast_enabled) && $req->podcast_enabled == 1) {
                        $podcast_enabled = 1;
                    } else {
                        $podcast_enabled = 0;
                    }
                    if (isset($req->movements_enabled) && $req->movements_enabled == 1) {
                        $movements_enabled = 1;
                    } else {
                        $movements_enabled = 0;
                    }
                    if (isset($req->log_sharing_enabled) && $req->log_sharing_enabled == 1) {
                        $log_sharing_enabled = 1;
                    } else {
                        $log_sharing_enabled = 0;
                    }
                    if (isset($req->cycle_length_report_enabled) && $req->cycle_length_report_enabled == 1) {
                        $cycle_length_report_enabled = 1;
                    } else {
                        $cycle_length_report_enabled = 0;
                    }
                    if (isset($req->mood_report_enabled) && $req->mood_report_enabled == 1) {
                        $mood_report_enabled = 1;
                    } else {
                        $mood_report_enabled = 0;
                    }
                    if (isset($req->energy_report_enabled) && $req->energy_report_enabled == 1) {
                        $energy_report_enabled = 1;
                    } else {
                        $energy_report_enabled = 0;
                    }
                    if (isset($req->general_report_enabled) && $req->general_report_enabled == 1) {
                        $general_report_enabled = 1;
                    } else {
                        $general_report_enabled = 0;
                    }
                    $package = new packages;
                    $package->package_title = $req->package_title;
                    $package->package_description = $req->package_description;
                    $package->tip_enabled = $tip_enabled;
                    $package->price = $req->price;
                    $package->video_enabled = $video_enabled;
                    $package->video_enabled = $video_enabled;
                    $package->blog_enabled = $blog_enabled;
                    $package->podcast_enabled = $podcast_enabled;
                    $package->movements_enabled = $movements_enabled;
                    $package->log_sharing_enabled = $log_sharing_enabled;
                    $package->cycle_length_report_enabled = $cycle_length_report_enabled;
                    $package->mood_report_enabled = $mood_report_enabled;
                    $package->energy_report_enabled = $energy_report_enabled;
                    $package->general_report_enabled = $general_report_enabled;
                    $package->package_expiry = $req->package_expiry;
                    $package->type = $req->package_type;
                    $package->status = $req->status;
                    $package->save();

                    return redirect('/admin/list-all-packages')->with('success', 'New package added successfully');
                } else {
                    return redirect()->back()->withInput()->with('msg', 'Please select at least one option');
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function Archivedpackage(){
        try {
            $data['packages'] = DB::table('packages')
                ->orderBy('package_id', 'DESC')->where('status',3)
                ->paginate(25);
            return view('/admin/archived-package', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function listPackage()
    {
        try {
            $data['packages'] = DB::table('packages')
                ->orderBy('package_id', 'DESC')->where('status','!=',3)
                ->paginate(25);
            return view('/admin/list-all-packages', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function deletepackage($package_id)
    {
        try {
            DB::table('packages')->where('package_id', $package_id)
            ->update(
                array(
                    'status' =>3
                )
            );
            return redirect('/admin/list-all-packages')->with('success', 'Package Archived Successfully!');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function undoPackage($package_id){
        try {
            DB::table('packages')->where('package_id', $package_id)
            ->update(
                array(
                    'status' =>1
                )
            );
            return redirect('/admin/archived-package')->with('success', 'Package Active Successfully!');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function editPackage($package_id)
    {
        try {
            $data['packages'] = DB::table('packages')
                ->where('package_id', $package_id)
                ->first();
            return view('admin/edit-packages', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function PackageDetails($id)
    {
        $data['package'] = DB::table('packages')->where('package_id', $id)->first();
        return view('admin/package-details', $data);
    }
    function updatePackage(Request $req)
    {

        try {
            $validator = Validator::make($req->all(), [
                'package_title' => ['required', 'string', 'max:255'],
                'package_description' => ['required', 'string', 'max:255'],
                'price' => ['required', 'numeric'],
                'package_expiry' => ['required'],
                'package_type' => ['required'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (isset($req->tip_enabled) || isset($req->video_enabled) || isset($req->blog_enabled) || isset($req->podcast_enabled) || isset($req->movements_enabled) ||  isset($req->log_sharing_enabled) ||  isset($req->cycle_length_report_enabled) || isset($req->mood_report_enabled) || isset($req->energy_report_enabled) || isset($req->general_report_enabled)) {
                    if (isset($req->tip_enabled) && $req->tip_enabled == 1) {
                        $tip_enabled = 1;
                    } else {
                        $tip_enabled = 0;
                    }
                    if (isset($req->video_enabled) && $req->video_enabled == 1) {
                        $video_enabled = 1;
                    } else {
                        $video_enabled = 0;
                    }
                    if (isset($req->blog_enabled) && $req->blog_enabled == 1) {
                        $blog_enabled = 1;
                    } else {
                        $blog_enabled = 0;
                    }
                    if (isset($req->podcast_enabled) && $req->podcast_enabled == 1) {
                        $podcast_enabled = 1;
                    } else {
                        $podcast_enabled = 0;
                    }
                    if (isset($req->movements_enabled) && $req->movements_enabled == 1) {
                        $movements_enabled = 1;
                    } else {
                        $movements_enabled = 0;
                    }
                    if (isset($req->log_sharing_enabled) && $req->log_sharing_enabled == 1) {
                        $log_sharing_enabled = 1;
                    } else {
                        $log_sharing_enabled = 0;
                    }
                    if (isset($req->cycle_length_report_enabled) && $req->cycle_length_report_enabled == 1) {
                        $cycle_length_report_enabled = 1;
                    } else {
                        $cycle_length_report_enabled = 0;
                    }
                    if (isset($req->mood_report_enabled) && $req->mood_report_enabled == 1) {
                        $mood_report_enabled = 1;
                    } else {
                        $mood_report_enabled = 0;
                    }
                    if (isset($req->energy_report_enabled) && $req->energy_report_enabled == 1) {
                        $energy_report_enabled = 1;
                    } else {
                        $energy_report_enabled = 0;
                    }
                    if (isset($req->tip_enabled) && $req->tip_enabled == 1) {
                        $general_report_enabled = 1;
                    } else {
                        $general_report_enabled = 0;
                    }

                    DB::table('packages')->where('package_id', $req->package_id)
                        ->update(
                            array(
                                'package_title' => $req->package_title,
                                'package_description' => $req->package_description,
                                'tip_enabled' => $tip_enabled,
                                'price' => $req->price,
                                'video_enabled' => $video_enabled,
                                'blog_enabled' => $blog_enabled,
                                'podcast_enabled' => $podcast_enabled,
                                'movements_enabled' => $movements_enabled,
                                'log_sharing_enabled' => $log_sharing_enabled,
                                'cycle_length_report_enabled' => $cycle_length_report_enabled,
                                'mood_report_enabled' => $mood_report_enabled,
                                'energy_report_enabled' => $energy_report_enabled,
                                'general_report_enabled' => $general_report_enabled,
                                'package_expiry' => $req->package_expiry,
                                'type' => $req->package_type,
                                'status' => $req->status
                            )
                        );
                    return redirect('/admin/list-all-packages')->with('success', 'Package Updated Successfully!');
                } else {
                    return redirect()->back()->withInput()->with('msg', 'Please select at least one option');
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function settingPackage()
    {
        $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type', 4)->where('status', 1)->get();
        $data['categorys'] = DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();
        $data['sub_energy']=DB::table('sub_energies')->get();

        return view('admin/tips-create', $data);
    }

    function getTipsSubCategory(Request $req)
    {
        try {
            $data = DB::table('categories')->where('parent_type', $req->category_id)->where('status', 1)->get();
            // dd($data);

            return response()->json(array('get_data' => $data), 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function undoTip($tip_id){
        try {
            DB::table('tips')->where('tip_id', $tip_id)
            ->update(
                array(
                    'status' => 1,
                )
            );
            return redirect('/admin/archived-tips')->with('success','Tip Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
function archivedTip(){
    try {
        $data['tips'] = DB::table('tips')->orderBy('tip_id', 'DESC')->where('status',3)
        ->paginate(25);
        $data['categories']=DB::table('categories')->where('status',1)->get();
        $data['categ']=DB::table('categories')->where('parent_type',0)->where('status',1)->get();

        $data['energy']=DB::table('mood_disorders')->where('disorders_type',4)->where('status',1)->get();
        // dd($data['categories']);
        return view('admin/archived-tips',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }


}
   function saveTips(Request $req)
    {

        try {
            $settings = DB::table('settings')->get();
            $bind_settings = array();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            $ext = strtolower($bind_settings['tips_image_extension']);
        $validator = Validator::make($req->all(), [
            'title' => 'required|string|max:30',
            'energy_id' => 'required',
            // 'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'image' => 'image|required|mimes:'.$ext.'',
            'description' => 'required|max:250',
            'status' => 'required',
            // 'expiry' => 'required',
            'language_id' => 'required',
            'gender_id' => 'required',
            'focus_id' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect('/admin/tips-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // dd('okk');
            $file_thumb = $req->image;
            // dd($req->image);
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/tips_image";
            $original_thub = strtolower(trim($req->image->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
            $tip = new tips;
            $tip->title = $req->title;
            $tip->energy_id = $req->energy_id;
            $tip->sub_energy_id=$req->sub_energy_id;
            // $tip->category_id = $req->category_id;
            // $tip->subcategory = $req->subcategory_id;
            $tip->language_id = $req->language_id;
            if(is_array($req->gender_id)){
                $tip->gender_id = implode(',',$req->gender_id);
            }else{
                $tip->gender_id = $req->gender_id;
            }
            if(is_array($req->focus_id)){
                $tip->focus_id = implode(',',$req->focus_id);
            }else{
                $tip->focus_id = $req->focus_id;
            }
            $settings = DB::table('settings')->get();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            if ($bind_settings['tips_image_size'] * 1000 >= $file_image_size) {

                    if ($bind_settings['tips_image_width'] >= $image_width_thumb) {
                        if ($bind_settings['tips_image_height'] >= $image_height_thumb) {
                            $tip->image = 'storage/tips_image/' . $file_name_thumb;
                        } else {
                            return redirect('/admin/tips-create')->with('error', 'The Uploaded Image Height is Too large');
                        }
                    } else {
                        return redirect('/admin/tips-create')->with('error', 'The Uploaded Image Width is Too large');
                    }

            } else {
                return redirect('/admin/tips-create')->with('error', 'The Uploaded Image is Too large');
            }
        }

        $tip->description = $req->description;
        $tip->expiry = $req->expiry;
        $tip->status = $req->status;
        // dd($tip);
        $tip->save();
        return redirect('/admin/list-all-tips')->with('success', 'New Tips added List Successfully');

        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('/admin/list-all-tips', $data);
        }

    }

  function listTip(Request $req)
{
    try {
        $data['tips'] = DB::table('tips')->orderBy('tip_id', 'DESC')->where('status', 1);

        if (!empty($req->language)) {
            $data['tips']->where('language_id', $req->language);
        }

        if (!empty($req->gender)) {
            $data['tips']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, gender_id)', [$req->gender]);
            });
        }
        if (!empty($req->focus)) {
            $data['tips']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, focus_id)', [$req->focus]);
            });
        }
        $data['tips'] = $data['tips']->paginate(25);

        $data['categories'] = DB::table('categories')->where('status', 1)->get();
        $data['categ'] = DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();
        $data['energy'] = DB::table('mood_disorders')->where('disorders_type', 4)->where('status', 1)->get();

        return view('admin/list-all-tips', $data);
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}



    function deleteTip($tip_id)
    {
        try {
            DB::table('tips')->where('tip_id', $tip_id)
            ->update(
                array(
                    'status' => 3,
                )
            );
            return redirect('/admin/list-all-tips')->with('success','Tip Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }

    function editTip($tip_id)
    {

        // try {

        $data['mood_disorders'] = DB::table('mood_disorders')->where('disorders_type', 4)->where('status', 1)->get();
        $data['tips'] = DB::table('tips')->where('tip_id', $tip_id)->get();
        // foreach ($data['tips'] as $olddata) {
        //     $subcategory = $olddata->subcategory;
        // }
        $data['sub_energy']=DB::table('sub_energies')->get();
        // $data['sub_category'] = DB::table('categories')->first();
        // $data['category'] = DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();
        // $data['sub_category'] = DB::table('categories')->where('category_id', $subcategory)->first();
        return view('/admin/edit-tips', $data);
        // } catch (\Exception $exception) {
        //     $data['error'] = $exception->getMessage();
        //     return view('/admin/list-all-tips', $data);
        // }
    }

    function tipsUpdate(Request $req)
    {
        // dd('okk');
        // try
        //  {
            $settings = DB::table('settings')->get();
        $bind_settings = array();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['tips_image_extension']);

        $validator = Validator::make($req->all(), [
            'title' => 'required|string|max:30',
            'energy_id' => 'required',
            // 'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'description' => 'required|max:250',
            // 'expiry' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/edit-tips/'.$req->tip_id)
                ->withErrors($validator)
                ->withInput();
        } else {
        if(isset($req->image)) {
            $validator = Validator::make($req->all(), [
                'image' => 'image|required|mimes:'.$ext.'',

            ]);

            if ($validator->fails()) {

                return redirect('/admin/edit-tips/'.$req->tip_id)
                    ->withErrors($validator)
                    ->withInput();
            } else {

            $file_thumb = $req->image;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/tipsimage";
            $original_thub = strtolower(trim($req->image->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
            $settings = DB::table('settings')->get();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            if ($bind_settings['tips_image_size'] * 1000 >= $file_image_size) {

                    if ($bind_settings['tips_image_width'] >= $image_width_thumb) {
                        if ($bind_settings['tips_image_height'] >= $image_height_thumb) {
                            DB::table('tips')->where('tip_id', $req->tip_id)
                                ->update(
                                    array(
                                        'image' => 'storage/tipsimage/' . $file_name_thumb,
                                    )
                                );
                        } else {
                            return redirect('/admin/edit-tips/'.$req->tip_id)->with('error', 'The Uploaded Image Height is Too large');
                        }
                    } else {
                        return redirect('/admin/edit-tips/'.$req->tip_id)->with('error', 'The Uploaded Image Width is Too large');
                    }

            } else {
                return redirect('/admin/edit-tips/'.$req->tip_id)->with('error', 'The Uploaded Image is Too large');
            }

    }
        }
        if(is_array($req->gender_id)){
            $req->gender_id = implode(',',$req->gender_id);
        }else{
            $req->gender_id = $req->gender_id;
        }
        if(is_array($req->focus_id)){
            $req->focus_id = implode(',',$req->focus_id);
        }else{
            $req->focus_id = $req->focus_id;
        }
        DB::table('tips')->where('tip_id', $req->tip_id)
            ->update(
                array(
                    'title' => $req->title,
                    'energy_id' => $req->energy_id,
                     'language_id' => $req->language_id,
                      'gender_id' => $req->gender_id,
                      'focus_id' => $req->focus_id,
                    'sub_energy_id'=>$req->sub_energy_id,
                    // 'category_id' => $req->category_id,
                    // 'subcategory' => $req->subcategory_id,
                    'description' => $req->description,
                    'expiry' => $req->expiry,
                    'status' => $req->status,
                )
            );

        return redirect('/admin/list-all-tips')->with('success', 'Tips Updated Successfully!');
        }
    }
    //  catch (\Exception $exception) {
    //     $data['error'] = $exception->getMessage();
    //     return view('/admin/list-all-tips', $data);
    // }

function  SearchCategory (Request $req){
    $search = $req->search;

    // dd($search);
    // dd($language);
    if ($search != '') {
        $category = DB::table('categories')->where('status', '!=', 3)
            ->Where('category_name', 'like', '%' . $search . '%')
            ->get('category_id');
        $ab = array();
        foreach ($category as $key) {
            array_push($ab, $key->category_id);
        }
        $data_loop = DB::table('tips')->whereIn('category_id', $ab)->where('status', '!=', 3)->orwhereIn('subcategory', $ab)
            ->orWhere('title', 'like', '%' . $search . '%')
            ->paginate(25);

        $categories = DB::table('categories')
            ->where('status', '!=', 3)
            ->get();
            $energy=DB::table('mood_disorders')->where('disorders_type',4)->where('status',1)->get();
        //   dd($data_loop);
        $data='';
         $i = $data_loop->perPage() * ($data_loop->currentPage() - 1) + 1;
        foreach ($data_loop as $loop) {

            $data .= '<tr style="" >
                <td>'. $i++.'</td>
                <td style="text-align:center;"><img
                src="'.env("APP_URL").'/'.$loop->image.'"
                style="height:40px;border-radius:6px;"></td>
                <td>'.ucfirst($loop->title).'</td>
                <td>';
                foreach ($categories as $keyy){
                           if($keyy->category_id == $loop->category_id){
                            $data.=ucfirst($keyy->category_name);
                          }
                           }

                $data.='</td>
                <td>';
                foreach ($categories as $keyy){
                           if($keyy->category_id == $loop->subcategory){
                             $data.=ucfirst($keyy->category_name);
                           }
                           }
                $data.='</td>
                <td>';
                foreach ($energy as $keyy){
                           if($keyy->disorders_id == $loop->energy_id){
                             $data.=ucfirst($keyy->name);
                           }
                           }
                $data.='</td>

                <td>'.ucfirst($loop->description).'</td>
                <td>'.$loop->expiry.'</td>
                <td style="text-align:center;" class="actions">';
                if($loop->status == 2){
               $data.='<span class="badge badge-dan text-danger d-inline">In-Active</span>';
                     }
                    if($loop->status == 3){
                        $data.='<span class="badge badge-dan text-danger  d-inline">Deleted</span>';
                     }
                     if($loop->status == 1){
                        $data.='<span class="badge badge-suc text-success  d-inline">Active</span>';
                     }
                $data.='</td>
                <td style="text-align:center;" class="actions"><a
                        href="/admin/edit-tips/'.$loop->tip_id.'"
                        class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>
                    <a href="/admin/delete-tips/'.$loop->tip_id.'"
                        class="btn-sm btn-del text-white mx-1 my-1 delete-row"
                        onclick="return confirm("Do you really want to delete '.ucfirst($loop->title).'this Tip? ")">Delete</a>
                </td>
            </tr>';

        }
        // dd($data);

        return response()->json(array('get_data' => $data));
    }
}}
