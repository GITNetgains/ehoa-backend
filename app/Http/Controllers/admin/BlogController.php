<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function createBlog(){

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

        return view('/admin/create-blogs', $data);

    }
}
