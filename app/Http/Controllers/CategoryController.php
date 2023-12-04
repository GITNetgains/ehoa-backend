<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\sub_categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    function categoryCreate()
    {
        try {
            $categoryget = DB::table('categories')->where('parent_type', 0)->where('status',1)->get();
            $sub_categories = DB::table('categories')
                ->leftJoin('sub_categories', 'sub_categories.cat_id', '=', 'categories.c_id')->where('status',1)
                ->get();
            return view('admin/category-create', ['categoryget' => $categoryget, 'sub_categories' => $sub_categories]);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }
    function categorySave(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'category_name' => ['required', 'string'],
                'parent_type' => ['required'],
                'category_info' => ['required', 'string'],
            ]);

            if ($validator->fails()) {

                return redirect('/admin/category-create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($req->parent_type == 0) {
                    $cat = new categories;
                    $cat->parent_type = $req->parent_type;
                    $cat->category_name = $req->category_name;
                    $cat->category_info = $req->category_info;
                    $cat->status = $req->status;
                    $cat->save();
                } else {
                    $caty = new sub_categories;
                    $caty->cat_id = $req->parent_type;
                    $caty->sub_parent_type = $req->parent_type;
                    $caty->sub_cat_name = $req->category_name;
                    $caty->sub_cat_info = $req->category_info;
                    $caty->sub_status = $req->status;
                    $caty->save();
                }
                return redirect('/admin/list-all-category')->with('success', 'New Category added successfully');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }
    function categoryList()
    {
        try {
            return view('/admin/list-all-category');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

    function nCreateCategory()
    {
        try {
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
            return view('/admin/n-create-category', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

     public function nSaveCategory(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'category_name' => 'required|max:50',
                'category_info' => 'required|max:300',
                'status' => 'required',
                'category_image' => ['required', 'mimes:jpeg,jpg,png'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                if (isset($req->category_image)) {
                    $file = $req->category_image;
                    $file_name = $file->getClientOriginalName();
                    $file_path = $file->getRealPath();
                    $file_size = $file->getSize();
                    $destinationPath = "storage/category_images";
                    $original_name = strtolower(trim($file->getClientOriginalName()));
                    $file_name = time() . rand(100, 999) . str_replace(' ', '-', $original_name);
                    $file->move($destinationPath, $file_name);
                    $category_image_name = '/' . $destinationPath . '/' . $file_name;
                }

                $categorys = new categories;
                $categorys->category_name = $req->category_name;
                $categorys->category_info = $req->category_info;
                $categorys->status = $req->status;

                // Calculate the path based on parent_type and category_name
                $parentCategory = DB::table('categories')
                    ->where('category_id', $req->parent_type)
                    ->first();

                if ($parentCategory) {
                    $categorys->path = $parentCategory->path . '/' . $req->category_name;
                } else {
                    $categorys->path = $req->category_name; // Default to category_name if parent_type not found
                }

                $categorys->parent_type = $req->parent_type;
                $categorys->category_image = $category_image_name;
                $categorys->save();
                return redirect('/admin/n-list-category');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

    function nListCategory()
    {
        try {
            $data['mydata'] = DB::table('categories')
                ->where('status','!=',3)
                ->get();
            $data['subcategories'] = DB::table('categories')->where('status','!=',3)
                ->where('parent_type', '!=', 0)
                ->get();
            return view('/admin/n-list-category', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

    function nEditCategory($c_id)
    {
        try {
            $data['olddata'] = DB::table('categories')->where('category_id', $c_id)->first();
            $data['categorys'] = DB::table('categories')->where('status',1)
                ->where('parent_type', 0)
                ->get();
            return view('/admin/n-edit-category', $data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }


    function nUpdateCategory(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'category_name' => 'required|max:50',
                'category_info' => 'required|max:300',
                'status' => 'required',
                'category_image' => 'mimes:jpg,png,jpeg'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                if (isset($req->category_image)) {
                    $file = $req->category_image;
                    $file_name = $file->getClientOriginalName();
                    $file_path = $file->getRealPath();
                    $file_size = $file->getSize();
                    $destinationPath = "storage/category_images";
                    $original_name = strtolower(trim($file->getClientOriginalName()));
                    $file_name = time() . rand(100, 999) . str_replace(' ', '-', $original_name);
                    $file->move($destinationPath, $file_name);
                    $category_image_name = '/' . $destinationPath . '/' . $file_name;
                    DB::table('categories')->where('category_id', $req->c_id)->update(array(
                        'category_image' => $category_image_name,
                    ));
                }
                DB::table('categories')->where('category_id', $req->c_id)->update(array(
                    'category_name' => $req->category_name,
                    'category_info' => $req->category_info,
                    'status' => $req->status,
                ));
                return redirect('/admin/n-list-category');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

    function nDeleteCategory($c_id, $parent)
    {
        try {
            if ($parent == 2) {
                DB::table('categories')->where('category_id', $c_id)->update(array(
                    'status' => 3,
                ));
                DB::table('categories')->where('category_id', $c_id)->where('parent_type', 0)->update(array(
                    'status' => 3,
                ));
            } else {
                DB::table('categories')->where('category_id', $c_id)->where('parent_type', '!=', 0)->update(array(
                    'status' => 3,
                ));

            }
            return redirect('/admin/n-list-category')->with('success','Category Archived Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }

    // function nSubCategory(){
    //     $data[ 'categorys' ] = DB::table( 'categories' )->get();
    //     return view('/admin/n-sub-category',$data);
    // }

    // function nSubSaveCategory(Request $req){
    //     // dd($req->all());
    //     $validator = Validator::make($req->all(),[
    //         'category'=>'required',
    //         'sub_cat_name'=>'required',
    //         'sub_cat_info'=>'required',
    //         'sub_status'=>'required',
    //     ]);
    //     if($validator->fails()){
    //         return redirect('/admin/n-sub-category')->withErrors($validator)->withInput();
    //     }else{
    //         // dd('ok');
    //         $sub= new sub_categories;
    //         $sub->cat_id=$req->category;
    //         $sub->sub_parent_type=1;
    //         $sub->sub_cat_name=$req->sub_cat_name;
    //         $sub->sub_cat_info=$req->sub_cat_info;
    //         $sub->sub_status=$req->sub_status;
    //         $sub->save();
    //         return redirect('/admin/n-sub-list-category');
    //     }
    // }
    // function nSubListCategory(){
    //     $data['mydata']=DB::table('sub_categories')
    //     ->leftJoin('categories','sub_categories.cat_id','=','categories.c_id')
    //     ->get();
    //     return view('/admin/n-sub-list-category',$data);
    // }


    // function nEditSubCategory($sub_cat_id){
    //     $data[ 'categorys' ] = DB::table( 'categories' )->get();
    //     $data['olddata']=DB::table('sub_categories')->where('sub_cat_id',$sub_cat_id)->first();
    //     return view('/admin/n-edit-sub-category',$data);
    // }

    // function nUpdateSubCategory(Request $req){
    //     DB::table('sub_categories')->where('sub_cat_id',$req->sub_cat_id)->update(array(
    //         'cat_id'=>$req->category,
    //         'sub_cat_name'=>$req->sub_cat_name,
    //         'sub_cat_info'=>$req->sub_cat_info,
    //         'sub_status'=>$req->sub_status,
    //     ));
    //     return redirect('/admin/n-sub-list-category');
    // }

    // function nDeleteSubCategory($sub_cat_id){
    //     DB::table('sub_categories')->where('sub_cat_id',$sub_cat_id)->delete();
    //     return redirect('/admin/n-sub-list-category');
    // }


    function nAssignToCategory()
    {
        $data['categorys'] = DB::table('categories')->get();
        $data['subs'] = DB::table('sub_categories')->get();
        $data['tips'] = DB::table('tips')->get();
        $data['videos'] = DB::table('videos')->get();
        $data['blogs'] = DB::table('blogs')->get();
        $data['podcasts'] = DB::table('podcasts')->get();
        $data['yogas'] = DB::table('yogas')->get();
        return view('/admin/n-assign-to-category', $data);
    }

    function getSubCategory(Request $req)
    {
        $data = DB::table('sub_categories')
            ->where('cat_id', $req->c_id)->get();
        return response()->json(array('get_data' => $data), 200);
    }

    function showAllList()
    {
        return view('/admin/show-all-list');
    }
    function ArchivedCategory(){
        try {
            $data['mydata'] = DB::table('categories')
                ->where('parent_type', '=', 0)->where('status',3)
                ->get();
            $data['subcategories'] = DB::table('categories')->where('status',3)
                ->where('parent_type', '!=', 0)
                ->get();

                return view('/admin/archived-category',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }

    }
    function UndoCategory($category_id,$parent){
        try {
            if ($parent == 2) {
                DB::table('categories')->where('category_id', $category_id)->update(array(
                    'status' => 1,
                ));
                DB::table('categories')->where('category_id', $category_id)->where('parent_type', 0)->update(array(
                    'status' => 1,
                ));
            } else {
                DB::table('categories')->where('category_id', $category_id)->where('parent_type', '!=', 0)->update(array(
                    'status' => 1,
                ));

            }
            return redirect('/admin/archived-category')->with('success','Category Active Successfully');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            $logs = $exception->getMessage();
            \Log::channel('st_logs')->info($logs);
            return view('error', $data);
        }
    }
}
