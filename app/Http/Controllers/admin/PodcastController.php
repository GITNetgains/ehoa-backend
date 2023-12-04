<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\podcasts;
use App\Models\sub_podcasts;
use App\Http\Controllers\Controller;
use Owenoj\LaravelGetId3\GetId3;

class PodcastController extends Controller
{
    function podcastCreate()
    {

        $data['categorys'] = DB::table('categories')
        ->where('status',1)
        ->get();

        $myArray = array();
        foreach ($data['categorys'] as $value) {
            if (!isset($myArray[$value->parent_type])) {
                $myArray[$value->parent_type] = array();
            }
            $myArray[$value->parent_type][$value->category_name] = $value;
        }
        $data['categories'] = $myArray;
        return view('admin/podcast-create', $data);
    }

    function getPodcastSubCategory(Request $req)
    {
        $data = DB::table('categories')
            ->where('parent_type', $req->category_id)->where('status', 1)->get();
        // dd($data);
        return response()->json(array('get_data' => $data), 200);
    }




    function podcastSave(Request $req)
    {
        $settings = DB::table('settings')->get();
        $bind_settings = array();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['podcast_image_extension']);

        $validator = Validator::make($req->all(), [
            'title' => 'required| max:30',
            'category_id' => 'required',
            'language_id' => 'required',
            'gender_id' => 'required',
            'audio_url' => 'required|url',
            'focus_id' => 'required',
            // 'subcategory_id' => 'required',
            'description' => 'required|max:250',
            'thumbnail' => 'image|required|mimes:' . $ext . '',
            'status' => 'required',

        ]);
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
        if ($validator->fails()) {

            return redirect('/admin/podcast-create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $podcast = new podcasts;
            $podcast->title = $req->title;
            $podcast->category_id = $req->category_id;
            $podcast->language_id = $req->language_id;
            $podcast->gender_id = $req->gender_id;
            $podcast->focus_id = $req->focus_id;
            $podcast->audio_url = $req->audio_url;
            // $podcast->subcategory_id = $req->subcategory_id;
            $podcast->description = $req->description;
            // if ( isset($req->file_url)) {
            //     if (isset($req->file_url)) {
            //         $validator = Validator::make($req->all(), [
            //             'file_url' => 'required|url',
            //         ]);

            //         if ($validator->fails()) {
            //             // dd($validator);
            //             return redirect('/admin/podcast-create')
            //                 ->withErrors($validator)
            //                 ->withInput();
            //         }
            //         $podcast->file_url = $req->file_url;
            //     }

            //     if (isset($req->audio)) {
            //         $validator = Validator::make($req->all(), [
            //             'audio' => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            //         ]);

            //         if ($validator->fails()) {
            //             // dd($validator);
            //             return redirect('/admin/podcast-create')
            //                 ->withErrors($validator)
            //                 ->withInput();
            //         }
            //         $file_audio = $req->audio;
            //         $getID3 = new GetID3($file_audio);
            //         $file_name = $file_audio->getClientOriginalName();
            //         $file_path = $file_audio->getRealPath();
            //         $file_image_size = $file_audio->getSize();
            //         $extension_audio = $file_audio->getClientOriginalExtension();
            //         $fileinfo = $getID3->extractInfo();
            //         $play_time = $fileinfo['playtime_string'];
            //         $destinationPath = "storage/podcast_audio";
            //         $original_audio = strtolower(trim($req->audio->getClientOriginalName()));
            //         $file_audio_name = time() . rand(100, 999) . str_replace(' ', '-', $original_audio);
            //         $file_audio->move($destinationPath, $file_audio_name);
            //         $podcast->audio = 'storage/podcast_audio/' . $file_audio_name;
            //         $podcast->audio_length = $play_time;
            //     }

            // } else {
            //     return redirect('/admin/podcast-create')->with('error', 'One Time Only One Field Mandatory from Audio & URL');
            // }

            $file_thumb = $req->thumbnail;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/podcast_thumbnails";
            $original_thub = strtolower(trim($req->thumbnail->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
            $settings = DB::table('settings')->get();
            $bind_settings = array();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            $data['bind_settings'] = $bind_settings;
            if ($bind_settings['podcast_image_size'] * 1000 >= $file_image_size) {

                if ($bind_settings['podcast_image_width'] >= $image_width_thumb) {
                    if ($bind_settings['podcast_image_height'] >= $image_height_thumb) {
                        $podcast->thumbnail = 'storage/podcast_thumbnails/' . $file_name_thumb;
                    } else {
                        return redirect('/admin/podcast-create')->with('error', 'The Uploaded Video Height is Too large');
                    }
                } else {
                    return redirect('/admin/podcast-create')->with('error', 'The Uploaded Image Width is Too large');
                }
            } else {
                return redirect('/admin/podcast-create')->with('error', 'The Uploaded Image is Too large');
            }

            $podcast->status = $req->status;
            $podcast->save();
            return redirect('/admin/list-all-podcast')->with('success', 'New Podcast added List Successfully');

        }
    }
    function podcastList(Request $req)
    {
        try {
            $data['categ']=DB::table('categories')->where('parent_type',0)->where('status',1)->get();
        $data['categories']=DB::table('categories')->where('status',1)->get();

            $data['podcast'] = DB::table('podcasts')->orderBy('podcast_id', 'DESC')->where('status','!=',3);
            if (!empty($req->language)) {
            $data['podcast']->where('language_id', $req->language);
        }

        if (!empty($req->gender)) {
            $data['podcast']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, gender_id)', [$req->gender]);
            });
        }
        if (!empty($req->focus)) {
            $data['podcast']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, focus_id)', [$req->focus]);
            });
        }
        $data['podcast'] = $data['podcast']->paginate(25);
            return view('admin/list-all-podcast', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }

    }

    function podcastDelete($podcast_id)
    {
        try {
            DB::table('podcasts')->where('podcast_id', $podcast_id)
            ->update(
                array(
                    'status' => 3,
                ));
            return redirect('/admin/list-all-podcast')->with('success','Podcast Archived Sucessfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function podcastEdit($podcast_id)
    {

        $data['podcasts'] = DB::table('podcasts')
            ->where('podcast_id', $podcast_id)
            ->get();
        foreach ($data['podcasts'] as $olddata) {
            $sub_category_id = $olddata->subcategory_id;

        }
        $data['category'] = DB::table('categories')->where('status', 1)->get();
        $data['sub_category'] = DB::table('categories')->where('category_id', $sub_category_id)->first();
        return view('/admin/edit-podcasts', $data);
    }


    function subpodcastUpdate(request $req)
    {
        $settings = DB::table('settings')->get();
        $bind_settings = array();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['podcast_image_extension']);

        $validator = Validator::make($req->all(), [
            'title' => 'required|max:30',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'required|string|max:250',
            'thumbnail' => 'image|mimes:' . $ext . '',
            'status' => 'required',
            'audio_url' => 'required|url',
            'url' => 'url',
        ]);

        if ($validator->fails()) {

            return redirect('/admin/edit-podcast/' . $req->id)
                ->withErrors($validator)
                ->withInput();
        } else {

            // if (isset($req->audio) || isset($req->file_url)) {
            //     if (isset($req->file_url)) {
            //         $validator = Validator::make($req->all(), [
            //             'file_url' => 'required|url',
            //         ]);

            //         if ($validator->fails()) {
            //             // dd($validator);
            //             return redirect('/admin/edit-podcast/' . $req->id)
            //                 ->withErrors($validator)
            //                 ->withInput();
            //         }
            //         DB::table('podcasts')->where('podcast_id', $req->id)->update(
            //             array(
            //                 'file_url' => $req->file_url,
            //             )
            //         );
            //     }

            //     if(isset($req->audio)) {
            //         $validator = Validator::make($req->all(), [
            //             'audio' => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            //         ]);

            //         if ($validator->fails()) {
            //             // dd($validator);
            //             return redirect('/admin/edit-podcast/' . $req->id)
            //                 ->withErrors($validator)
            //                 ->withInput();
            //         }

            //         $file_audio = $req->audio;
            //         $getID3 = new GetID3($file_audio);
            //         $file_name = $file_audio->getClientOriginalName();
            //         $file_path = $file_audio->getRealPath();
            //         $file_image_size = $file_audio->getSize();
            //         $extension_audio = $file_audio->getClientOriginalExtension();
            //         $fileinfo = $getID3->extractInfo();
            //         $play_time = $fileinfo['playtime_string'];
            //         $destinationPath = "storage/podcast_audio";
            //         $original_audio = strtolower(trim($req->audio->getClientOriginalName()));
            //         $file_audio_name = time() . rand(100, 999) . str_replace(' ', '-', $original_audio);
            //         $file_audio->move($destinationPath, $file_audio_name);
            //         DB::table('podcasts')->where('podcast_id', $req->id)->update(
            //             array(
            //                 'audio' => $destinationPath . '/' . $file_audio_name,
            //                 'audio_length'=>$play_time,
            //             )
            //         );

            //     }

            // }
            // else {
            //     return redirect('/admin/edit-podcast/' . $req->id)->with('error', 'One Time Only One Field Mandatory from Audio & URL');
            // }
            if(isset($req->thumbnail)){
            $file_thumb = $req->thumbnail;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/podcast_thumbnails";
            $original_thub = strtolower(trim($req->thumbnail->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
            $settings = DB::table('settings')->get();
            $bind_settings = array();
            foreach ($settings as $setting) {
                $bind_settings[$setting->key] = $setting->value;
            }
            $data['bind_settings'] = $bind_settings;
            if ($bind_settings['podcast_image_size'] * 1000 >= $file_image_size) {

                if ($bind_settings['podcast_image_width'] >= $image_width_thumb) {
                    if ($bind_settings['podcast_image_height'] >= $image_height_thumb) {
                        DB::table('podcasts')->where('podcast_id', $req->id)->update(
                            array(
                                'thumbnail' => $destinationPath . '/' . $file_name_thumb,
                            )
                        );
                    } else {
                        return redirect('/admin/edit-podcast/' . $req->id)->with('error', 'The Uploaded Video Height is Too large');
                    }
                } else {
                    return redirect('/admin/edit-podcast/' . $req->id)->with('error', 'The Uploaded Image Width is Too large');
                }
            } else {
                return redirect('/admin/edit-podcast/' . $req->id)->with('error', 'The Uploaded Image is Too large');
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
            DB::table('podcasts')->where('podcast_id', $req->id)
                    ->update(
                        array(
                            'title' => $req->title,
                            'category_id' => $req->category_id,
                            'subcategory_id' => $req->subcategory_id,
                            'language_id' => $req->language_id,
                            'gender_id' => $req->gender_id,
                            'focus_id' => $req->focus_id,
                            'description' => $req->description,
                            'audio_url' => $req->audio_url,
                            // 'file_url' => $req->file_url,
                            'status' => $req->status,

                        )
                    );

                    return redirect('/admin/list-all-podcast')->with('success', 'Podcast Updated Successfully!');

        }
    }

function searchpodcast(Request $req){
    // dd($req->all());
    // try {
        $search = $req->search;
        // dd($search);
        if ($search != '') {
            $category = DB::table('categories')
                ->Where('category_name', 'like', '%' . $search . '%')->where('status', '!=', 3)
                ->get('category_id');
            $ab = array();
            foreach ($category as $key) {
                array_push($ab, $key->category_id);
            }
            $data_loop = DB::table('podcasts')->whereIn('category_id', $ab)->where('status', 1)->orwhereIn('subcategory_id', $ab)
                ->orWhere('title', 'like', '%' . $search . '%')
                ->paginate(25);
            $categories = DB::table('categories')
                ->where('status', '!=', 3)
                ->get();
            //   dd($data_loop);
            $data='';
             $i = $data_loop->perPage() * ($data_loop->currentPage() - 1) + 1;
            foreach ($data_loop as $loop) {

                $data .= '<tr style="" >
                    <td>'. $i++.'</td>

                    <td>'.$loop->title.'</td>
                    <td>';
                    foreach ($categories as $keyy){
                               if($keyy->category_id == $loop->category_id){
                                $data.=ucfirst($keyy->category_name);
                              }
                               }

                    $data.='</td>
                    <td>';
                    foreach ($categories as $keyy){
                               if($keyy->category_id == $loop->subcategory_id){
                                 $data.=ucfirst($keyy->category_name);
                               }
                               }
                    $data.='</td>
                    <td style="text-align:center;"><img
                            src="'.env("APP_URL").'/'.$loop->thumbnail.'"
                            style="height:40px;border-radius:6px;"></td>

                    <td>'.ucfirst($loop->description).'</td>
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
                            href="/admin/edit-podcast/'.$loop->podcast_id.'"
                            class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>
                        <a href="/admin/delete-podcast/'.$loop->podcast_id.'"
                            class="btn-sm btn-del text-white mx-1 my-1 delete-row"
                            onclick="return confirm("Do you really want to delete '.ucfirst($loop->title).'this Video? ")">Delete</a>
                    </td>
                </tr>';

            }
            // dd($data);

            return response()->json(array('get_data' => $data));
        }
    // } catch (\Exception $exception) {
    //     $data['error'] = $exception->getMessage();
    //     return view('error', $data);
    // }
}
function podcastArchived(){
    try {
        $data['categ']=DB::table('categories')->where('parent_type',0)->where('status',1)->get();
    $data['categories']=DB::table('categories')->where('status',1)->get();

        $data['podcast'] = DB::table('podcasts')->orderBy('podcast_id', 'DESC')->where('status',3)
        ->paginate(25);
        return view('/admin/archived-podcast', $data);
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}
function podcastUndo($podcast_id){
    try {
        DB::table('podcasts')->where('podcast_id', $podcast_id)
        ->update(
            array(
                'status' => 1,
            ));
        return redirect('/admin/archived-podcast')->with('success','Podcast Active Sucessfully');
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
}
}
