<?php

namespace App\Http\Controllers\blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Owenoj\LaravelGetId3\GetId3;
use App\Models\blogs;
use App\Models\blog_slides;
use Illuminate\Support\Facades\Validator;

class NewBlogHandleController extends Controller
{
    function deleteBlog($id)
    {

        DB::table('blogs')->where('blog_id', $id)
            ->update(
                array(
                    'status' => 3
                )
            );
        // DB::table('blog_slides')->where('blog_id',$id)
        // ->update(array(
        //     'status' => 3
        // ));

        return redirect('admin/get-list-blog')->with('success', 'Blog Added  Archived successfully');
    }
    function UndoBlog($id)
    {
        DB::table('blogs')->where('blog_id', $id)
            ->update(
                array(
                    'status' => 1
                )
            );
        return redirect('admin/archived-blog')->with('success', 'Blog Active Successfully');
    }
    function deleteBlogSlide($id)
    {
        DB::table('blogs')->where('blog_id', $id)
            ->update(
                array(
                    'status' => 3
                )
            );
        return redirect('admin/get-list-blog')->with('success', 'Blog Slide deleted successfully');
    }
    function getBlog()
    {
        // $data['energys'] = DB::table('mood_disorders')->where('disorders_type',4)->get();
        $data['categorys'] = DB::table('categories')
            ->where('status', 1)
            ->get();
        return view('/admin/new-blogs-create', $data);
    }
    function EditBlog($id)
    {
        $data['blogs'] = DB::table('blogs')
            ->where('blog_id', $id)
            ->first();
        $data['subcategory'] = DB::table('categories')
            ->where('category_id', $data['blogs']->subcategory_id)
            ->first();

        $data['slides'] = DB::table('blog_slides')
            ->where('blog_id', $id)
            ->get();
        // dd($data);
        $data['categorys'] = DB::table('categories')
            ->where('status', 1)
            ->get();

        return view('/admin/edit-blogs', $data);
    }

    function EditBlogSlide($id)
    {
        $data['slide'] = DB::table('blog_slides')
            ->where('slide_id', $id)
            ->first();
        return view('/admin/edit-blogs-slide', $data);
    }
    function DeleteSlideBlog($slide_id)
    {
        DB::table('blog_slides')->where('slide_id', $slide_id)->delete();
        return redirect()->back()->with('error', 'Slide Deleted Successfully');
    }

    function saveEditBlogSlide(Request $req)
    {


        $settings = DB::table('settings')->get();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['blogs_image_extension']);
        $width = $bind_settings['blogs_image_width'];
        $height = $bind_settings['blogs_image_height'];
        $validator = Validator::make($req->all(), [
            'slide_title' => ['required | max:30'],
            'slide_description' => ['required |max:250'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if (isset($req->product_url)) {
                $url = $req->product_url;
            } else {
                $url = null;
            }

            if (isset($req->slide_image)) {

                $file_thumb = $req->slide_image;
                $file_name = $file_thumb->getClientOriginalName();
                $file_path_thumb = $file_thumb->getRealPath();
                $file_image_size = $file_thumb->getSize();
                $rl = $file_path_thumb;
                $sj = getimagesize($rl);
                $image_width_thumb = $sj[0];
                $image_height_thumb = $sj[1];
                $extension_image = $file_thumb->getClientOriginalExtension();
                $destinationPath = "storage/blogs";
                $original_thub = strtolower(trim($req->slide_image->getClientOriginalName()));
                $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                // $file_thumb->move($destinationPath, $file_name_thumb);
                if ($file_image_size > $bind_settings['blogs_image_size'] * 1000) {
                    return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                } elseif ($image_width_thumb > $width || $image_height_thumb > $height) {
                    return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                } else {
                    $file_thumb->move($destinationPath, $file_name_thumb);
                    $blog_image = $destinationPath . '/' . $file_name_thumb;
                    DB::table('blog_slides')
                        ->where('slide_id', $req->id)
                        ->update(
                            array(
                                'slide_image' => $blog_image
                            )
                        );
                }
            }
            DB::table('blog_slides')
                ->where('slide_id', $req->id)
                ->update(
                    array(
                        'slide_title' => $req->slide_title,
                        'slide_description' => $req->slide_description,
                        'product_url' => $url,
                    )
                );
            return redirect('admin/get-list-blog')->with('success', 'Blog Slide updated successfully');
        }
    }

    function getBlogList(Request $req)
    {
        $data['blogs'] = DB::table('blogs')
            ->orderBy('blog_id', 'DESC')->where('status', '!=', 3);
        if (!empty($req->language)) {
            $data['blogs']->where('language_id', $req->language);
        }

        if (!empty($req->gender)) {
            $data['blogs']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, gender_id)', [$req->gender]);
            });
        }
        if (!empty($req->focus)) {
            $data['blogs']->where(function ($query) use ($req) {
                $query->WhereRaw('FIND_IN_SET(?, focus_id)', [$req->focus]);
            });
        }

        // $dataType = gettype($data['blogs']);

        // foreach ($data['blogs'] as $blog) {
        //     $categ = DB::table('categories')
        //     ->where('category_id', $blog->category_id)
        //     ->get();
        //     dd($categ);
        //     $blog->path = $categ->path;
        // }


        $data['blogs'] = $data['blogs']->paginate(25);
        $data['slides'] = DB::table('blog_slides')
            ->orderBy('slide_id', 'DESC')
            ->get();
        return view('admin/list-all-blogs', $data);
    }
    function getBlogsSubCategory(Request $req)
    {
        $data = DB::table('categories')->where('parent_type', $req->category_id)->get();
        return response()->json(array('get_data' => $data), 200);
    }
    public function saveBlog(Request $req)
    {
        $settings = DB::table('settings')->get();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['blogs_image_extension']);
        $width = $bind_settings['blogs_image_width'];
        $height = $bind_settings['blogs_image_height'];

        // dd($ext);
        $validator = Validator::make($req->all(), [
            'category_id' => ['required'],
            'gender_id' => ['required'],
            'focus_id' => ['required'],
            'language_id' => ['required'],
            // 'subcategory_id' => ['required'],
            'title' => ['max:30', 'required', 'string'],
            'image' => ['image', 'required', 'mimes:' . $ext],
            'description' => ['max:250', 'required', 'string'],
            'author_name' => ['max:255', 'required', 'string'],
            'tags' => ['max:255', 'required', 'string'],
            'status' => ['required'],
        ]);
        $slideTitleRules = ['max:30', 'required', 'string'];
        $slideDescriptionRules = ['max:250', 'required', 'string'];

        $slideTitles = $req->slide_title ?? [];
        $slideDescriptions = $req->slide_description ?? [];

        foreach ($slideTitles as $key => $slideTitle) {
            $validator->sometimes(
                'slide_title.' . $key,
                $slideTitleRules,
                function ($input) use ($key) {
                    return isset($input->slide_title[$key]);
                }
            );

            $validator->sometimes(
                'slide_description.' . $key,
                $slideDescriptionRules,
                function ($input) use ($key) {
                    return isset($input->slide_description[$key]);
                }
            );
        }

        if (is_array($req->gender_id)) {
            $req->gender_id = implode(',', $req->gender_id);
        } else {
            $req->gender_id = $req->gender_id;
        }
        if (is_array($req->focus_id)) {
            $req->focus_id = implode(',', $req->focus_id);
        } else {
            $req->focus_id = $req->focus_id;
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // dd($req->all());

            if (isset($req->image)) {
                $file_thumb = $req->image;
                $file_name = $file_thumb->getClientOriginalName();
                $file_path_thumb = $file_thumb->getRealPath();
                $file_image_size = $file_thumb->getSize();
                $rl = $file_path_thumb;
                $sj = getimagesize($rl);
                $image_width_thumb = $sj[0];
                $image_height_thumb = $sj[1];
                $extension_image = $file_thumb->getClientOriginalExtension();
                $destinationPath = "storage/blogs";
                $original_thub = strtolower(trim($req->image->getClientOriginalName()));
                $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                // $file_thumb->move($destinationPath, $file_name_thumb);
                if ($file_image_size > $bind_settings['blogs_image_size'] * 1000) {
                    return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                } elseif ($image_width_thumb > $width || $image_height_thumb > $height) {
                    return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                } else {
                    $file_thumb->move($destinationPath, $file_name_thumb);
                    $blog_image = $destinationPath . '/' . $file_name_thumb;
                }
            }
            $blogs = new blogs;
            $blogs->category_id = $req->category_id;
            $blogs->language_id = $req->language_id;
            $blogs->gender_id = $req->gender_id;
            $blogs->focus_id = $req->focus_id;
            $blogs->subcategory_id = $req->subcategory_id;
            $blogs->title = $req->title;
            $blogs->image = $blog_image;
            $blogs->author_name = $req->author_name;
            $blogs->description = $req->description;
            $blogs->tags = $req->tags;
            $blogs->status = $req->status;
            $blogs->save();
            $last = DB::getPdo()->lastInsertId();
            // dd($last);
            $title = $req->slide_title;
            $desc = $req->slide_description;
            $image = $req->slide_image;

            if (isset($req->product_url)) {
                $product_url = $req->product_url;
            } else {
                $product_url = [];
            }
            foreach ($title as $tit) {
                if (count($product_url) < count($title)) {
                    array_push($product_url, null);
                }
            }
            foreach ($title as $key => $titles) {
                $data = array(
                    'titles' => $titles,
                    'desc' => $desc[$key],
                    'image' => $image[$key],
                    'product_url' => $product_url[$key],
                );
                if (isset($image[$key])) {
                    $slide_images = $image[$key];
                    $file_thumb1 = $slide_images;
                    $file_name1 = $file_thumb1->getClientOriginalName();
                    $file_path_thumb1 = $file_thumb1->getRealPath();
                    $file_image_size1 = $file_thumb1->getSize();
                    $rl1 = $file_path_thumb1;
                    $sj1 = getimagesize($rl1);
                    $image_width_thumb1 = $sj1[0];
                    $image_height_thumb1 = $sj1[1];
                    $extension_image1 = $file_thumb1->getClientOriginalExtension();
                    $destinationPath1 = "storage/blogs";
                    $original_thub1 = strtolower(trim($slide_images->getClientOriginalName()));
                    $file_name_thumb1 = time() . rand(100, 999) . str_replace(' ', '-', $original_thub1);
                    // $file_thumb->move($destinationPath, $file_name_thumb);
                    if ($file_image_size1 > $bind_settings['blogs_image_size'] * 1000) {
                        DB::table('blogs')->where('blog_id', $last)->delete();
                        return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Slide Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                    } elseif ($image_width_thumb1 > $width || $image_height_thumb1 > $height) {
                        DB::table('blogs')->where('blog_id', $last)->delete();
                        return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                    } else {
                        $file_thumb1->move($destinationPath1, $file_name_thumb1);
                        $slide_image_name = $destinationPath1 . '/' . $file_name_thumb1;
                    }
                } else {
                    $slide_image_name = '/';
                }
                $slides = new blog_slides;
                $slides->blog_id = $last;
                $slides->slide_title = $titles;
                $slides->slide_description = $desc[$key];
                $slides->slide_image = $slide_image_name;
                $slides->product_url = $product_url[$key];
                $slides->save();
            }
            return redirect('/admin/get-list-blog');
        }
    }
    function ArchivedBlog()
    {
        $data['blogs'] = DB::table('blogs')
            ->orderBy('blog_id', 'DESC')->where('status', 3)
            ->paginate(25);
        $data['slides'] = DB::table('blog_slides')
            ->orderBy('slide_id', 'DESC')
            ->get();
        return view('/admin/archived-blog', $data);
    }

    function saveEditBlogNEW(Request $req)

    {
// dd($req->all());
        $settings = DB::table('settings')->get();
        foreach ($settings as $setting) {
            $bind_settings[$setting->key] = $setting->value;
        }
        $ext = strtolower($bind_settings['blogs_image_extension']);
        $width = $bind_settings['blogs_image_width'];
        $height = $bind_settings['blogs_image_height'];

        // dd($ext);
        $validator = Validator::make($req->all(), [
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'title' => ['max:255', 'required', 'string'],
            'description' => ['max:255', 'required', 'string'],
            'author_name' => ['max:255', 'required', 'string'],
            'tags' => ['max:255', 'required', 'string'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {


            if (isset($req->image)) {
                $validator = Validator::make($req->all(), [
                    'image' => ['mimes:' . $ext],
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
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
                    $destinationPath = "storage/blogs";
                    $original_thub = strtolower(trim($req->image->getClientOriginalName()));
                    $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                    // $file_thumb->move($destinationPath, $file_name_thumb);
                    if ($file_image_size > $bind_settings['blogs_image_size'] * 1000) {
                        return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                    } elseif ($image_width_thumb > $width || $image_height_thumb > $height) {
                        return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                    } else {
                        $file_thumb->move($destinationPath, $file_name_thumb);
                        $blog_image = $destinationPath . '/' . $file_name_thumb;
                        DB::table('blogs')->where('blog_id', $req->id)
                            ->update(
                                array(
                                    'image' => $blog_image
                                )
                            );
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
            DB::table('blogs')->where('blog_id', $req->id)
                ->update(
                    array(
                        'category_id' => $req->category_id,
                        'language_id' => $req->language_id,
                        'gender_id' => $req->gender_id,
                        'focus_id' => $req->focus_id,
                        'subcategory_id' => $req->subcategory_id,
                        'title' => $req->title,
                        'author_name' => $req->author_name,
                        'description' => $req->description,
                        'tags' => $req->tags,
                        'status' => $req->status,
                    )
                );

                if (isset($req->slide_title_new)) {
                    $title_new = $req->slide_title_new;
                    $desc_new = $req->slide_description_new;
                    $image_new = $req->slide_image_new;

                    if (isset($req->product_url_new)) {
                        $product_url_new = $req->product_url_new;
                    } else {
                        $product_url_new = [];
                    }
                    foreach ($title_new as $tit) {
                        if (count($product_url_new) < count($title_new)) {
                            array_push($product_url_new, null);
                        }
                    }
                    foreach ($title_new as $key => $titles_new) {
                        $data = array(
                            'titles_new' => $titles_new,
                            'desc_new' => $desc_new[$key],
                            'image_new' => $image_new[$key],
                            'product_url_new' => $product_url_new[$key],
                        );
                        if(isset($image_new[$key])) {
                            $slide_images = $image_new[$key];
                            $file_thumb1 = $slide_images;
                            $file_name1 = $file_thumb1->getClientOriginalName();
                            $file_path_thumb1 = $file_thumb1->getRealPath();
                            $file_image_size1 = $file_thumb1->getSize();
                            $rl1 = $file_path_thumb1;
                            $sj1 = getimagesize($rl1);
                            $image_width_thumb1 = $sj1[0];
                            $image_height_thumb1 = $sj1[1];
                            $extension_image1 = $file_thumb1->getClientOriginalExtension();
                            $destinationPath1 = "storage/blogs";
                            $original_thub1 = strtolower(trim($slide_images->getClientOriginalName()));
                            $file_name_thumb1 = time() . rand(100, 999) . str_replace(' ', '-', $original_thub1);
                            // $file_thumb->move($destinationPath, $file_name_thumb);
                            if ($file_image_size1 > $bind_settings['blogs_image_size'] * 1000) {

                                return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Slide Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                            } elseif ($image_width_thumb1 > $width || $image_height_thumb1 > $height) {

                                return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                            } else {
                                $file_thumb1->move($destinationPath1, $file_name_thumb1);
                                $slide_image_name = $destinationPath1 . '/' . $file_name_thumb1;
                            }
                        } else {
                            $slide_image_name = '/';
                        }
                        $slides = new blog_slides;
                        $slides->blog_id = $req->id;
                        $slides->slide_title = $titles_new;
                        $slides->slide_description = $desc_new[$key];
                        $slides->slide_image = $slide_image_name;
                        $slides->product_url = $product_url_new[$key];
                        $slides->save();
                    }
                }
              if(isset($req->slide_title)) {
                //   dd('okk');
                $title = $req->slide_title;
                $desc = $req->slide_description;

                $slide_id = $req->slide_id;
                if (isset($req->slide_image)) {
                    $image = $req->slide_image;
                } else {
                    $image = [];
                }
                if (isset($req->product_url)) {
                    $product_url = $req->product_url;
                } else {
                    $product_url = [];
                }
                foreach ($title as $tit) {
                    if (count($product_url) < count($title)) {
                        array_push($product_url, null);
                    }
                }

                foreach ($title as $key => $titles) {

                    $data = array(
                        'titles' => $titles,
                        'desc' => $desc[$key],
                        'slide_id' => $slide_id[$key],
                        'product_url' => $product_url[$key],
                    );
                    //  dd($slide_id[$key]);

                    $data['get_slide_ids'] = DB::table('blog_slides')->where('blog_id', $req->id)->select('blog_slides.slide_id')->get();
                    $exist_slides_array = [];
                    foreach ($data['get_slide_ids'] as $exist_slide_ids) {
                        array_push($exist_slides_array, $exist_slide_ids->slide_id);
                    }
                    if (in_array($slide_id[$key], $exist_slides_array)) {
                        if (array_key_exists($slide_id[$key], $image)) {
                            // dd($req->slide_image[$slide_id[$key]]);
                            $slide = $req->slide_image[$slide_id[$key]];
                            $file_thumb1 = $slide->getClientOriginalName();
                            $file_path_thumb1 = $slide->getRealPath();
                            // dd($file_path_thumb1);
                            $file_image_size1 = $slide->getSize();
                            $rl1 = $file_path_thumb1;
                            $sj1 = getimagesize($rl1);
                            $image_width_thumb1 = $sj1[0];
                            $image_height_thumb1 = $sj1[1];
                            $extension_image1 = $slide->getClientOriginalExtension();
                            $destinationPath1 = "storage/blogs";
                            $original_thub1 = strtolower(trim($slide->getClientOriginalName()));
                            $file_name_thumb1 = time() . rand(100, 999) . str_replace(' ', '-', $original_thub1);
                            if ($file_image_size1 > $bind_settings['blogs_image_size'] * 1000) {
                                // DB::table('blog_slides')->where('slide_id', $slide_id[$key])->delete();
                                return redirect()->back()->withInput()->with('msg', 'The Uploaded Size of Slide Image is Less Than ' . $bind_settings['blogs_image_size'] . 'KB');
                            } elseif ($image_width_thumb1 > $width || $image_height_thumb1 > $height) {
                                // DB::table('blog_slides')->where('blog_id', $slide_id[$key])->delete();
                                return redirect()->back()->withInput()->with('msg', 'The Uploaded Image dimension is must be  ' . $width . 'X' . $height);
                            } else {
                                $slide->move($destinationPath1, $file_name_thumb1);
                                $slide_image_name = $destinationPath1 . '/' . $file_name_thumb1;
                                ;
                                DB::table('blog_slides')->where('slide_id', $slide_id[$key])
                                ->update(
                                    array(
                                        'slide_image' => $slide_image_name,

                                    )
                                );
                            }
                        }

                        DB::table('blog_slides')->where('slide_id', $slide_id[$key])
                        ->update(
                            array(
                                'slide_title' => $titles,
                                'slide_description' => $desc[$key],
                                'product_url' => $product_url[$key],
                            )
                        );
                    }

                }


               }
            return redirect('admin/get-list-blog')->with('success', 'Blog updated successfully');
        }

    }
}
