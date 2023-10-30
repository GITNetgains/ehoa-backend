<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\videos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Owenoj\LaravelGetId3\GetId3;

class VideoController extends Controller
{
    function videosCreate()
    {
        $data['category'] = DB::table('categories')->where('status', 1)->get();

        return view('/admin/videos-create', $data);
    }
    function videosSave(Request $req)
    {
        $settings = DB::table('settings')->get();
        $bind_settings = array();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['podcast_image_extension']);
        $v_ext = strtolower($bind_settings['vedio_vedio_extension']);

        $validator = Validator::make($req->all(), [
            'title' => 'required|max:30',
            'category_id' => 'required',
            'language_id' => 'required',
            'gender_id' => 'required',
            'focus_id' => 'required',
            // 'subcategory_id' => 'required',
            'description' => 'required|string|max:250',
            'thumbnails' => 'image|required|mimes:' . $ext . '',
            'status' => 'required',
            'file_url' => 'required'
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

            return redirect('/admin/videos-create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $videos = new videos;
            $videos->title = $req->title;
            $videos->category_id = $req->category_id;
            $videos->language_id = $req->language_id;
            $videos->gender_id = $req->gender_id;
            $videos->focus_id = $req->focus_id;
            // $videos->subcategory_id = $req->subcategory_id;
            $videos->description = $req->description;
            // $videos->video_length= 'null';
            if (isset($req->video) || isset($req->file_url)) {
                if (isset($req->file_url)) {
                    $validator = Validator::make($req->all(), [
                        'file_url' => 'required|url',
                    ]);

                    if ($validator->fails()) {
                        // dd($validator);
                        return redirect('/admin/videos-create')
                            ->withErrors($validator)
                            ->withInput();
                    }
                    $videos->file_url = $req->file_url;
                }

                if (isset($req->video)) {
                    $validator = Validator::make($req->all(), [
                        'video' => 'required|mimes:' . $v_ext . '',
                    ]);

                    if ($validator->fails()) {
                        // dd($validator);
                        return redirect('/admin/videos-create')
                            ->withErrors($validator)
                            ->withInput();
                    }

                    $file_video = $req->video;
                    $getID3 = new GetID3($file_video);
                    $file_vedio_path = $file_video->getRealPath();
                    $filename = $file_vedio_path;
                    $fileinfo = $getID3->extractInfo();
                    $data_file = $fileinfo['video'];
                    $video_size = $fileinfo['filesize'];
                    $video_extension = $fileinfo['fileformat'];
                    $play_time = $fileinfo['playtime_string'];
                    $videos->video_length= $play_time;
                    $video_height = $data_file['resolution_y'];
                    $video_width = $data_file['resolution_x'];
                    $file_name = $file_video->getClientOriginalName();
                    $destinationPath = "storage/video";
                    $original_name_video = strtolower(trim($req->video->getClientOriginalName()));
                    $file_name_v = time() . rand(100, 999) . str_replace(' ', '-', $original_name_video);
                    $file_video->move($destinationPath, $file_name_v);

                    if($bind_settings['vedio_vedio_size'] * 1000 >= $video_size) {
                            if ($bind_settings['vedio_vedio_width'] >= $video_width) {
                                if ($bind_settings['vedio_vedio_height'] >= $video_height) {
                                    if ($bind_settings['vedio_vedio_length'] >= $play_time) {
                                        $videos->video = 'storage/video/' . $file_name_v;
                                    } else {
                                        return redirect('/admin/videos-create')->with('error', 'The Auto Play Length  for Video is Too Large');
                                    }
                                } else {
                                    return redirect('/admin/videos-create')->with('error', 'The Uploaded Video Length is Too large');
                                }
                            } else {
                                return redirect('/admin/videos-create')->with('error', 'The Uploaded Video Height is Too large');
                            }

                    } else {
                        return redirect('/admin/videos-create')->with('error', 'The Uploaded Video Size is Too large');
                    }

                }

            } else {
                return redirect('/admin/videos-create')->with('error', 'Video url feild is required');
            }

            $file_thumb = $req->thumbnails;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/video_thumbnails";
            $original_thub = strtolower(trim($req->thumbnails->getClientOriginalName()));
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
                        $videos->thumbnails = 'storage/video_thumbnails/' . $file_name_thumb;
                    } else {
                        return redirect('/admin/videos-create')->with('error', 'The Uploaded Video Height is Too large');
                    }
                } else {
                    return redirect('/admin/videos-create')->with('error', 'The Uploaded Image Width is Too large');
                }
            } else {
                return redirect('/admin/videos-create')->with('error', 'The Uploaded Image is Too large');
            }

            $videos->status = $req->status;

            $videos->save();
            return redirect('/admin/list-all-videos')->with('success', 'New Video added List Successfully');
        }
        }


    function videosList(Request $req)
    {
        $data['categ'] = DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();
        $data['categories'] = DB::table('categories')->where('status', 1)->get();
        $data['video'] = DB::table('videos')->orderBy('video_id', 'DESC')->where('status', 1);
        if (!empty($req->language)) {
            $data['video']->where('language_id', $req->language);
        }
        if (!empty($req->gender)) {
            $data['video']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, gender_id)', [$req->gender]);
            });
        }
        if (!empty($req->focus)) {
            $data['video']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, focus_id)', [$req->focus]);
            });
        }
        $data['video'] = $data['video']->paginate(25);
        return view('admin/list-all-videos', $data);
    }
    function videosDelete($video_id)
    {
        try {
            DB::table('videos')->where('video_id', $video_id)
                ->update(
                    array(
                        'status' => 3,
                    )
                );
            return redirect('/admin/list-all-videos')->with('success', 'Video Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function videosEdit($video_id)
    {
        try {
            $data['videos'] = DB::table('videos')
                ->where('video_id', $video_id)
                ->get();
            foreach ($data['videos'] as $olddata) {
                // $sub_category_id = $olddata->subcategory_id;
            }

            $data['category'] = DB::table('categories')->where('status', 1)->get();
            $data['sub_category'] = DB::table('categories')->where('category_id', $sub_category_id)->first();
            // dd($data);
            return view('/admin/edit-videos', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }


    function videosUpdate(Request $req)
    {
        $settings = DB::table('settings')->get();
        $bind_settings = array();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['podcast_image_extension']);
        $v_ext = strtolower($bind_settings['vedio_vedio_extension']);

        $validator = Validator::make($req->all(), [
            'title' => 'required|max:30',
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'description' => 'required|string|max:250',
            'thumbnails' => 'image|mimes:' . $ext . '',
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

            return redirect('/admin/edit-videos/' . $req->id)
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::table('videos')->where('video_id', $req->id)
                ->update(
                    array(
                        'title' => $req->title,
                        'category_id' => $req->category_id,
                        'language_id' => $req->language_id,
                        'gender_id' => $req->gender_id,
                        'focus_id' => $req->focus_id,
                        // 'subcategory_id' => $req->subcategory_id,
                        'description' => $req->description,
                        'status' => $req->status,

                    )
                );

            if (isset($req->video) || isset($req->file_url)) {
                if (isset($req->file_url)) {
                    $validator = Validator::make($req->all(), [
                        'file_url' => 'required|url',
                    ]);

                    if ($validator->fails()) {
                        // dd($validator);
                        return redirect('/admin/edit-videos/' . $req->id)
                            ->withErrors($validator)
                            ->withInput();
                    }
                    DB::table('videos')->where('video_id', $req->id)->update(
                        array(
                            'file_url' => $req->file_url,
                        )
                    );
                }

                // if(isset($req->video)) {
                //     $validator = Validator::make($req->all(), [
                //         'video' => 'required|mimes:' . $v_ext . '',
                //     ]);

                //     if ($validator->fails()) {
                //         // dd($validator);
                //         return redirect('/admin/edit-videos/' . $req->id)
                //             ->withErrors($validator)
                //             ->withInput();
                //     }
                //     $file_video = $req->video;
                //     $getID3 = new GetID3($file_video);
                //     $file_vedio_path = $file_video->getRealPath();
                //     $filename = $file_vedio_path;
                //     $fileinfo = $getID3->extractInfo();
                //     $data_file = $fileinfo['video'];
                //     $video_size = $fileinfo['filesize'];
                //     $video_extension = $fileinfo['fileformat'];
                //     $play_time = $fileinfo['playtime_string'];
                //     $video_height = $data_file['resolution_y'];
                //     $video_width = $data_file['resolution_x'];
                //     $file_name = $file_video->getClientOriginalName();
                //     $destinationPath = "storage/video";
                //     $original_name_video = strtolower(trim($req->video->getClientOriginalName()));
                //     $file_name_v = time() . rand(100, 999) . str_replace(' ', '-', $original_name_video);
                //     $file_video->move($destinationPath, $file_name_v);
                //     // DB::table('videos')->where('video_id', $req->id)->update(
                //     //     array(

                //     //         'video_length' => $play_time,
                //     //     )
                //     // );
                //     if ($bind_settings['vedio_vedio_size'] * 1000 >= $video_size) {
                //         if ($bind_settings['vedio_vedio_width'] >= $video_width) {
                //             if ($bind_settings['vedio_vedio_height'] >= $video_height) {
                //                 if ($bind_settings['vedio_vedio_length'] >= $play_time) {
                //                     DB::table('videos')->where('video_id', $req->id)->update(
                //                         array(
                //                             'video' => $destinationPath . '/' . $file_name_v,
                //                             // 'video_length' => $play_time,
                //                         )
                //                     );
                //                 } else {
                //                     return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Auto Play Length  for Video is Too Large');
                //                 }
                //             } else {
                //                 return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Video Length is Too large');
                //             }
                //         } else {
                //             return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Video Height is Too large');
                //         }
                //     } else {
                //         return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Video Size is Too large');
                //     }



                // }

            }
            //  else {
            //     return redirect('/admin/edit-videos/'.$req->id)->with('error', 'One Time Only One Field Mandatory from Video & URL');
            // }
            if (isset($req->thumbnails)) {
                $file_thumb = $req->thumbnails;
                $file_name = $file_thumb->getClientOriginalName();
                $file_path_thumb = $file_thumb->getRealPath();
                $file_image_size = $file_thumb->getSize();
                $rl = $file_path_thumb;
                $sj = getimagesize($rl);
                $image_width_thumb = $sj[0];
                $image_height_thumb = $sj[1];
                $extension_image = $file_thumb->getClientOriginalExtension();
                $destinationPath = "storage/video_thumbnails";
                $original_thub = strtolower(trim($req->thumbnails->getClientOriginalName()));
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
                            DB::table('videos')->where('video_id', $req->id)->update(
                                array(
                                    'thumbnails' => $destinationPath . '/' . $file_name_thumb,
                                )
                            );
                        } else {
                            return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Video Height is Too large');
                        }
                    } else {
                        return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Image Width is Too large');
                    }
                } else {
                    return redirect('/admin/edit-videos/' . $req->id)->with('error', 'The Uploaded Image is Too large');
                }

            }
            return redirect('/admin/list-all-videos')->with('success', 'Videos Updated Successfully!');

        }
    }

    function getVideoSubCategory(Request $req)
    {
        // dd($req->category_id);
        try {
            $data = DB::table('categories')->where('parent_type', $req->category_id)->where('status', 1)->get();
            // dd($data);

            return response()->json(array('get_data' => $data), 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function SearchVideo(Request $req)
    {
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
            $data_loop = DB::table('videos')->whereIn('category_id', $ab)->where('status', 1)
            // ->orwhereIn('subcategory_id', $ab)
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
                            src="'.env("APP_URL").'/'.$loop->thumbnails.'"
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
                            href="/admin/edit-videos/'.$loop->video_id.'"
                            class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>
                        <a href="/admin/delete-videos/'.$loop->video_id.'"
                            class="btn-sm btn-del text-white mx-1 my-1 delete-row"
                            onclick="return confirm("Do you really want to delete '.ucfirst($loop->title).'this Video? ")">Delete</a>
                    </td>
                </tr>';

            }
            // dd($data);

            return response()->json(array('get_data' => $data));
        }
    }

    function videosAchived()
    {
        $data['categ'] = DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();
        $data['categories'] = DB::table('categories')->where('status', 1)->get();
        $data['video'] = DB::table('videos')->orderBy('video_id', 'DESC')->where('status', 3)
            ->paginate(25);
        return view('admin/archived-video', $data);
    }
    function videosUndo($video_id)
    {
        try {

            DB::table('videos')->where('video_id', $video_id)
                ->update(
                    array(
                        'status' => 1,
                    )
                );
            return redirect('/admin/archived-video')->with('success', 'Video Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
}
