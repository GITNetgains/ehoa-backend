<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function createBlog(){

        $data['categorys']=DB::table('categories')->where('status', 1)->get();

        return view('/admin/create-blogs', $data);

    }
}
