<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    function createBlog(){
        
        $data['categorys']=DB::table('categories')->where('parent_type', 0)->where('status', 1)->get();

        return view('/admin/create-blogs', $data);

    }
}
